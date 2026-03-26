package com.example.rentalsystem.dao;

import com.example.rentalsystem.model.Customer;
import com.example.rentalsystem.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CustomerDAO {

    public void insert(Customer customer) throws SQLException {
        String sql = "INSERT INTO Customers (full_name, phone, email, password) VALUES (?, ?, ?, ?)";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, customer.getFullName());
            ps.setString(2, customer.getPhone());
            ps.setString(3, customer.getEmail());
            ps.setString(4, customer.getPassword());
            ps.executeUpdate();
        }
    }

    public List<Customer> getAll() throws SQLException {
        List<Customer> customers = new ArrayList<>();
        String sql = "SELECT * FROM Customers";
        try (Connection conn = DBConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Customer c = new Customer();
                c.setCustomerId(rs.getInt("customer_id"));
                c.setFullName(rs.getString("full_name"));
                c.setPhone(rs.getString("phone"));
                c.setEmail(rs.getString("email"));
                c.setPassword(rs.getString("password"));
                c.setCreatedAt(rs.getTimestamp("created_at"));
                customers.add(c);
            }
        }
        return customers;
    }

    public Customer getById(int id) throws SQLException {
        String sql = "SELECT * FROM Customers WHERE customer_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    Customer c = new Customer();
                    c.setCustomerId(rs.getInt("customer_id"));
                    c.setFullName(rs.getString("full_name"));
                    c.setPhone(rs.getString("phone"));
                    c.setEmail(rs.getString("email"));
                    c.setPassword(rs.getString("password"));
                    c.setCreatedAt(rs.getTimestamp("created_at"));
                    return c;
                }
            }
        }
        return null;
    }

    public void update(Customer customer) throws SQLException {
        String sql = "UPDATE Customers SET full_name = ?, phone = ?, email = ?, password = ? WHERE customer_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, customer.getFullName());
            ps.setString(2, customer.getPhone());
            ps.setString(3, customer.getEmail());
            ps.setString(4, customer.getPassword());
            ps.setInt(5, customer.getCustomerId());
            ps.executeUpdate();
        }
    }

    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM Customers WHERE customer_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }
}
