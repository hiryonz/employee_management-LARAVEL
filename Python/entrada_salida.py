import mysql.connector
from mysql.connector import Error
from datetime import datetime, timedelta
import time

# Conexión a la base de datos
def get_db_connection():
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",  
            database="employee_management",
            port=3306,
            connection_timeout=30
        )
        if conn.is_connected():
            return conn
    except Error as err:
        print(f"Error: {err}")
    return None


# Función para insertar la entrada
def insert_entrada(cedula, authcode):
    
    hora = time.strftime('%H:%M:%S') 
    fecha = datetime.now().strftime('%Y-%m-%d')
    created_at = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    updated_at = created_at

    conn = get_db_connection()
    cursor = conn.cursor()

    # Verificar si ya existe una entrada para el empleado el día de hoy
    query_check = """
                SELECT * 
                FROM entrada_salida e 
                INNER JOIN qr_code qr ON e.cedula = qr.cedula 
                WHERE e.cedula = %s AND e.fecha = %s AND qr.authcode = %s
                """
    cursor.execute(query_check, (cedula, fecha, authcode))
    existing_entry = cursor.fetchone()
    if existing_entry:
        # Si ya existe una entrada, comprobar si ya tiene salida
        if existing_entry[4] == '0:00:00' or not existing_entry[4]:
            update_salida(cedula, hora)
        else:
            print(f"El empleado {cedula} ya ha registrado su salida.")
    else:
        # Si no existe la entrada, insertamos la nueva entrada
        query_insert = """
        INSERT INTO entrada_salida (cedula, fecha, hora_entrada, created_at, updated_at)
        SELECT %s, %s, %s, %s, %s
        WHERE EXISTS (SELECT 1 FROM employee WHERE cedula = %s)
        """
        values = (cedula, fecha, hora, created_at, updated_at, cedula)

        try:
            cursor.execute(query_insert, values)
            if cursor.rowcount == 0:
                print("Error: La cédula no existe en la tabla 'employee'.")
            else:
                conn.commit()
                print("Entrada registrada con éxito.")
        except mysql.connector.Error as err:
            print(f"Error: {err}")
            conn.rollback()  # Rollback en caso de error

    cursor.close()
    conn.close()

# Función para actualizar la salida
def update_salida(cedula, hora_salida):
    # Obtener la fecha actual y la fecha/hora de actualización
    fecha = datetime.now().strftime('%Y-%m-%d')
    updated_at = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    # Conexión a la base de datos
    conn = get_db_connection()
    cursor = conn.cursor()

    # Verificar si existe una entrada para el empleado el día de hoy
    query_check = "SELECT created_at FROM entrada_salida WHERE cedula = %s AND fecha = %s"
    cursor.execute(query_check, (cedula, fecha))
    existing_entry = cursor.fetchone()

    if existing_entry:
        hora_salida = datetime.strptime(hora_salida, '%H:%M:%S').time()
        hora_entrada = datetime.strptime(existing_entry[0].strftime('%H:%M:%S'), '%H:%M:%S').time()

        diferencia = datetime.combine(datetime.min, hora_salida) - datetime.combine(datetime.min, hora_entrada)

        print(diferencia)
        diferencia_segundos = diferencia.total_seconds()
        print(diferencia_segundos)

        # Verificar si ha pasado más de 10 minutos (600 segundos)
        if diferencia_segundos > 600:
            # Realizar la actualización de la hora de salida
            query_update = """
            UPDATE entrada_salida
            SET hora_salida = %s, updated_at = %s
            WHERE cedula = %s AND fecha = %s
            """
            values = (hora_salida, updated_at, cedula, fecha)

            try:
                cursor.execute(query_update, values)
                conn.commit()  # Confirmar los cambios
                print("Salida registrada con éxito.")
            except mysql.connector.Error as err:
                print(f"Error: {err}")
                conn.rollback()  # Rollback en caso de error
        else:
            print("Posible error de escaneo, intente en 10 minutos después de su escaneo.")
    else:
        print(f"No se ha encontrado entrada registrada para el empleado {cedula}.")
    cursor.close()
    conn.close()
