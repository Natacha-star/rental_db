# Rental Management System (Java CRUD)

This is a simple, beginner-friendly Java web application built using Servlets, JSP, and JDBC.

## Project Structure
- `src/`: Contains Java source files (Model, DAO, Servlet, Util).
- `WebContent/`: Contains JSP pages, HTML, CSS, and web resources.
- `WEB-INF/`: Contains `web.xml` deployment descriptor.

## Tech Stack
- **Java**: Servlets and JSP
- **Server**: Apache Tomcat 9.0+
- **Database**: MySQL (via JDBC)
- **UI**: Bootstrap 5.3

---

## Setup Guide (Follow these steps)

### 1. Import Project into IDE
- **Eclipse**: File > Import > General > Existing Projects into Workspace > Select this folder.
- **IntelliJ**: File > Open > Select this folder.

### 2. Add MySQL Connector (JAR)
- Download `mysql-connector-java-x.x.x.jar`.
- Right-click project > **Build Path** > **Configure Build Path**.
- Go to **Libraries** > **Add External JARs** > Select the downloaded jar.
- **IMPORTANT**: Also copy the JAR file into `WebContent/WEB-INF/lib/` folder.

### 3. Configure Database
- Open XAMPP and start MySQL.
- Open phpMyAdmin (http://localhost/phpmyadmin).
- Create a database: `Rental_Management_Database`.
- Import the `db.sql` file provided in the parent directory.
- Verify `DBConnection.java` connection details (URL, Username, Password).

### 4. Configure Tomcat Server
- In your IDE, add a new **Server** (Apache Tomcat).
- Add this project to the server's configured resources.

### 5. Run the Application
- Right-click project > **Run As** > **Run on Server**.
- Open your browser at: `http://localhost:8080/RentalSystemJava/`

---

## Features
- **Customers**: List, Add, Edit, Delete.
- **Landlords**: List, Add, Edit, Delete.
- **Properties**: List, Add, Edit, Delete. Links to Landlords.
- **Rentals**: List, Add, Edit, Delete. Links Properties to Customers.

## Navigation
Use the navbar at the top to switch between modules:
`Home | Customers | Landlords | Properties | Rentals`
