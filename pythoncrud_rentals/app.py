from flask import Flask, render_template, request, redirect, url_for, flash
import db
from mysql.connector import Error

app = Flask(__name__)
app.secret_key = 'some_student_app_secret_key'

# --- Home Route ---
@app.route('/')
@app.route('/home')
def home():
    return render_template('home.html')

# --- Customers CRUD ---
@app.route('/customers')
def list_customers():
    connection = db.get_db_connection()
    if connection:
        cursor = connection.cursor(dictionary=True)
        cursor.execute("SELECT * FROM Customers ORDER BY created_at DESC")
        customers = cursor.fetchall()
        cursor.close()
        connection.close()
        return render_template('customers.html', customers=customers)
    return "Database Connection Failed"

@app.route('/customers/add', methods=['GET', 'POST'])
def add_customer():
    if request.method == 'POST':
        full_name = request.form['full_name']
        phone = request.form['phone']
        email = request.form['email']
        # Note: In a student project, we keep it simple as requested.
        # However, password is required in schema, we provide a placeholder.
        password = 'default_student_password' 
        
        connection = db.get_db_connection()
        if connection:
            try:
                cursor = connection.cursor()
                sql = "INSERT INTO Customers (full_name, phone, email, password) VALUES (%s, %s, %s, %s)"
                cursor.execute(sql, (full_name, phone, email, password))
                connection.commit()
                flash('Customer added successfully!', 'success')
            except Error as e:
                flash(f'Error: {e}', 'danger')
            finally:
                cursor.close()
                connection.close()
            return redirect(url_for('list_customers'))
    return render_template('add_customer.html')

@app.route('/customers/edit/<int:id>', methods=['GET', 'POST'])
def edit_customer(id):
    connection = db.get_db_connection()
    if not connection: return "DB Error"
    
    cursor = connection.cursor(dictionary=True)
    if request.method == 'POST':
        full_name = request.form['full_name']
        phone = request.form['phone']
        email = request.form['email']
        
        sql = "UPDATE Customers SET full_name=%s, phone=%s, email=%s WHERE customer_id=%s"
        cursor.execute(sql, (full_name, phone, email, id))
        connection.commit()
        cursor.close()
        connection.close()
        flash('Customer updated successfully!', 'success')
        return redirect(url_for('list_customers'))
    
    cursor.execute("SELECT * FROM Customers WHERE customer_id = %s", (id,))
    customer = cursor.fetchone()
    cursor.close()
    connection.close()
    return render_template('edit_customer.html', customer=customer)

@app.route('/customers/delete/<int:id>')
def delete_customer(id):
    connection = db.get_db_connection()
    if connection:
        cursor = connection.cursor()
        cursor.execute("DELETE FROM Customers WHERE customer_id = %s", (id,))
        connection.commit()
        cursor.close()
        connection.close()
        flash('Customer deleted successfully!', 'info')
    return redirect(url_for('list_customers'))

# --- Properties CRUD ---
@app.route('/properties')
def list_properties():
    connection = db.get_db_connection()
    if connection:
        cursor = connection.cursor(dictionary=True)
        # Simplified query as per instructions
        cursor.execute("SELECT p.*, l.full_name as landlord_name FROM Properties p JOIN Landlords l ON p.landlord_id = l.landlord_id ORDER BY p.created_at DESC")
        properties = cursor.fetchall()
        cursor.close()
        connection.close()
        return render_template('properties.html', properties=properties)
    return "Database Connection Failed"

@app.route('/properties/add', methods=['GET', 'POST'])
def add_property():
    connection = db.get_db_connection()
    cursor = connection.cursor(dictionary=True)
    
    if request.method == 'POST':
        landlord_id = request.form['landlord_id']
        title = request.form['title']
        location = request.form['location']
        price = request.form['price']
        status = request.form['status']
        
        sql = "INSERT INTO Properties (landlord_id, title, location, price, status) VALUES (%s, %s, %s, %s, %s)"
        cursor.execute(sql, (landlord_id, title, location, price, status))
        connection.commit()
        cursor.close()
        connection.close()
        return redirect(url_for('list_properties'))
    
    cursor.execute("SELECT landlord_id, full_name FROM Landlords")
    landlords = cursor.fetchall()
    cursor.close()
    connection.close()
    return render_template('add_property.html', landlords=landlords)

@app.route('/properties/edit/<int:id>', methods=['GET', 'POST'])
def edit_property(id):
    connection = db.get_db_connection()
    cursor = connection.cursor(dictionary=True)
    
    if request.method == 'POST':
        title = request.form['title']
        location = request.form['location']
        price = request.form['price']
        status = request.form['status']
        
        sql = "UPDATE Properties SET title=%s, location=%s, price=%s, status=%s WHERE property_id=%s"
        cursor.execute(sql, (title, location, price, status, id))
        connection.commit()
        return redirect(url_for('list_properties'))
    
    cursor.execute("SELECT * FROM Properties WHERE property_id = %s", (id,))
    prop = cursor.fetchone()
    cursor.close()
    connection.close()
    return render_template('edit_property.html', property=prop)

@app.route('/properties/delete/<int:id>')
def delete_property(id):
    connection = db.get_db_connection()
    cursor = connection.cursor()
    cursor.execute("DELETE FROM Properties WHERE property_id = %s", (id,))
    connection.commit()
    cursor.close()
    connection.close()
    return redirect(url_for('list_properties'))

# --- Rentals CRUD ---
@app.route('/rentals')
def list_rentals():
    connection = db.get_db_connection()
    if connection:
        cursor = connection.cursor(dictionary=True)
        cursor.execute("""
            SELECT r.*, p.title as property_title, c.full_name as customer_name 
            FROM Rentals r 
            JOIN Properties p ON r.property_id = p.property_id 
            JOIN Customers c ON r.customer_id = c.customer_id
            ORDER BY r.start_date DESC
        """)
        rentals = cursor.fetchall()
        cursor.close()
        connection.close()
        return render_template('rentals.html', rentals=rentals)
    return "Database Connection Failed"

@app.route('/rentals/add', methods=['GET', 'POST'])
def add_rental():
    connection = db.get_db_connection()
    cursor = connection.cursor(dictionary=True)
    
    if request.method == 'POST':
        property_id = request.form['property_id']
        customer_id = request.form['customer_id']
        start_date = request.form['start_date']
        end_date = request.form['end_date'] if request.form['end_date'] else None
        payment_status = request.form['payment_status']
        
        sql = "INSERT INTO Rentals (property_id, customer_id, start_date, end_date, payment_status) VALUES (%s, %s, %s, %s, %s)"
        cursor.execute(sql, (property_id, customer_id, start_date, end_date, payment_status))
        connection.commit()
        # Update property status to Rented
        cursor.execute("UPDATE Properties SET status = 'Rented' WHERE property_id = %s", (property_id,))
        connection.commit()
        cursor.close()
        connection.close()
        return redirect(url_for('list_rentals'))
    
    cursor.execute("SELECT property_id, title FROM Properties WHERE status = 'Available'")
    properties = cursor.fetchall()
    cursor.execute("SELECT customer_id, full_name FROM Customers")
    customers = cursor.fetchall()
    cursor.close()
    connection.close()
    return render_template('add_rental.html', properties=properties, customers=customers)

@app.route('/rentals/edit/<int:id>', methods=['GET', 'POST'])
def edit_rental(id):
    connection = db.get_db_connection()
    cursor = connection.cursor(dictionary=True)
    
    if request.method == 'POST':
        start_date = request.form['start_date']
        end_date = request.form['end_date'] if request.form['end_date'] else None
        payment_status = request.form['payment_status']
        
        sql = "UPDATE Rentals SET start_date=%s, end_date=%s, payment_status=%s WHERE rental_id=%s"
        cursor.execute(sql, (start_date, end_date, payment_status, id))
        connection.commit()
        cursor.close()
        connection.close()
        return redirect(url_for('list_rentals'))
    
    cursor.execute("SELECT * FROM Rentals WHERE rental_id = %s", (id,))
    rental = cursor.fetchone()
    cursor.close()
    connection.close()
    return render_template('edit_rental.html', rental=rental)

@app.route('/rentals/delete/<int:id>')
def delete_rental(id):
    connection = db.get_db_connection()
    cursor = connection.cursor()
    cursor.execute("DELETE FROM Rentals WHERE rental_id = %s", (id,))
    connection.commit()
    cursor.close()
    connection.close()
    return redirect(url_for('list_rentals'))

if __name__ == '__main__':
    app.run(debug=True)
