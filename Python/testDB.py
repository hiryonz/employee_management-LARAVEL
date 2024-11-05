import pymysql

# Replace with your actual database connection details
host = '127.0.0.1'  # e.g., '34.123.45.67'
user = 'root'
password = ''

# Establishing the connection
try:
    connection = pymysql.connect(
        host=host,
        user=user,
        password=password,
        port=3306  # Default MySQL port
    )

    print("Connection successful!")

    # Create a cursor object
    cursor = connection.cursor()

    # Execute a query to show databases
    cursor.execute("SHOW DATABASES;")
    all_databases = cursor.fetchall()

    for db in all_databases:
        print(db)

except pymysql.MySQLError as err:
    print(f"Error: {err}")
finally:
    if 'connection' in locals() and connection.open:
        connection.close()
        print("Connection closed.")
