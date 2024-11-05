import mysql.connector
from mysql.connector import Error
from datetime import datetime


# Database connection
try:
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",  # Add your root password here
        database="employee_management",
        port=3306,
        connection_timeout=30
    )

    if conn.is_connected():
        cursor = conn.cursor()
        print("Connection successful!")
except Error as err:
    print(f"Error: {err}")



# Function to insert data
def insert_entrada(cedula, hora_entrada):
    fecha = datetime.now().strftime('%Y-%m-%d')
    created_at = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    updated_at = datetime.now().strftime('%Y-%m-%d %H:%M:%S')



    query = """
    INSERT INTO entrada_salida (cedula, fecha, hora_entrada, created_at, updated_at)
    SELECT %s, %s, %s, %s, %s
    WHERE EXISTS (SELECT 1 FROM employee WHERE cedula = %s)
    """
    values = (cedula, fecha, hora_entrada, created_at, updated_at, cedula)

    try:
        cursor.execute(query, values)
        if cursor.rowcount == 0:
             print("Error: La cédula no existe en la tabla 'employee'.")
        else:
            conn.commit()  # Commit the transaction
            print("Datos insertados con éxito.")
    except mysql.connector.Error as err:
        print(f"Error: {err}")
        conn.rollback()  # Rollback in case of error


    conn.close()
    cursor.close()

def update_salida(cedula, hora_salida):
    fecha = datetime.now().strftime('%Y-%m-%d')
    updated_at = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    query = """
    UPDATE entrada_salida SET
    hora_salida = %s,
    updated_at = %s
    WHERE cedula like %s and DATE(fecha) like %s
    """

    values = (hora_salida, updated_at, cedula, fecha)

    try:
        cursor.execute(query, values)
        if cursor.rowcount == 0:
             print("Error: La cédula no existe en la tabla 'employee'.")
        else:
            conn.commit()
            print("update data successfully")
    except mysql.connector.Error as err:
        print(f"Error: {err}")
        conn.rollback()  # Rollback in case of error
    
    conn.close()
    cursor.close()




