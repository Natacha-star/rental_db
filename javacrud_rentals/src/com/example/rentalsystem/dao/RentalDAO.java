package com.example.rentalsystem.dao;

import com.example.rentalsystem.model.Rental;
import com.example.rentalsystem.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class RentalDAO {

    public void insert(Rental rental) throws SQLException {
        String sql = "INSERT INTO Rentals (property_id, customer_id, start_date, end_date, payment_status) VALUES (?, ?, ?, ?, ?)";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, rental.getPropertyId());
            ps.setInt(2, rental.getCustomerId());
            ps.setDate(3, rental.getStartDate());
            ps.setDate(4, rental.getEndDate());
            ps.setString(5, rental.getPaymentStatus());
            ps.executeUpdate();
        }
    }

    public List<Rental> getAll() throws SQLException {
        List<Rental> rentals = new ArrayList<>();
        String sql = "SELECT * FROM Rentals";
        try (Connection conn = DBConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Rental r = new Rental();
                r.setRentalId(rs.getInt("rental_id"));
                r.setPropertyId(rs.getInt("property_id"));
                r.setCustomerId(rs.getInt("customer_id"));
                r.setStartDate(rs.getDate("start_date"));
                r.setEndDate(rs.getDate("end_date"));
                r.setPaymentStatus(rs.getString("payment_status"));
                rentals.add(r);
            }
        }
        return rentals;
    }

    public Rental getById(int id) throws SQLException {
        String sql = "SELECT * FROM Rentals WHERE rental_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    Rental r = new Rental();
                    r.setRentalId(rs.getInt("rental_id"));
                    r.setPropertyId(rs.getInt("property_id"));
                    r.setCustomerId(rs.getInt("customer_id"));
                    r.setStartDate(rs.getDate("start_date"));
                    r.setEndDate(rs.getDate("end_date"));
                    r.setPaymentStatus(rs.getString("payment_status"));
                    return r;
                }
            }
        }
        return null;
    }

    public void update(Rental rental) throws SQLException {
        String sql = "UPDATE Rentals SET property_id = ?, customer_id = ?, start_date = ?, end_date = ?, payment_status = ? WHERE rental_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, rental.getPropertyId());
            ps.setInt(2, rental.getCustomerId());
            ps.setDate(3, rental.getStartDate());
            ps.setDate(4, rental.getEndDate());
            ps.setString(5, rental.getPaymentStatus());
            ps.setInt(6, rental.getRentalId());
            ps.executeUpdate();
        }
    }

    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM Rentals WHERE rental_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }
}
