package com.example.rentalsystem.util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 * Utility class to handle database connections using JDBC.
 */
public class DBConnection {
    // Database credentials
    private static final String URL = "jdbc:mysql://localhost:3306/Rental_Management_Database?useSSL=false&allowPublicKeyRetrieval=true";
    private static final String USER = "root";
    private static final String PASSWORD = "Natacha@MySql123"; // Updated with user's new password

    public static Connection getConnection() {
        Connection conn = null;
        try {
            // Register MySQL JDBC driver
            Class.forName("com.mysql.cj.jdbc.Driver");
            // Establish connection
            conn = DriverManager.getConnection(URL, USER, PASSWORD);
        } catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
        }
        return conn;
    }
}
