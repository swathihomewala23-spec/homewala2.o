import mysql.connector

# We know the app runs on localhost mysql. Let's try root/<empty> or typical laravel credentials.
# I'll just parse .env
env = {}
with open('.env', 'r') as f:
    for line in f:
        if '=' in line and not line.startswith('#'):
            k, v = line.strip().split('=', 1)
            env[k] = v

try:
    conn = mysql.connector.connect(
        host=env.get('DB_HOST', '127.0.0.1'),
        user=env.get('DB_USERNAME', 'root'),
        password=env.get('DB_PASSWORD', ''),
        database=env.get('DB_DATABASE', 'laravel')
    )
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT id, first_name, last_name, photo FROM vendors")
    for row in cursor.fetchall():
        print(f"Vendor: {row['first_name']} {row['last_name']}, Photo: {row['photo']}")
except Exception as e:
    print(f"Error: {e}")
