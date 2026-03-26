package com.example.rentalsystem.dao;

import com.example.rentalsystem.model.Landlord;
import com.example.rentalsystem.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class LandlordDAO {

    public void insert(Landlord landlord) throws SQLException {
        // Based on the provided schema, landlord_id is not AUTO_INCREMENT. 
        // For a simple demo, we expect the user to provide an ID or we can handle it.
        // I will write this assuming landlord_id is provided in the object.
        String sql = "INSERT INTO Landlords (landlord_id, full_name, phone, email, password) VALUES (?, ?, ?, ?, ?)";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, landlord.getLandlordId());
            ps.setString(2, landlord.getFullName());
            ps.setString(3, landlord.getPhone());
            ps.setString(4, landlord.getEmail());
            ps.setString(5, landlord.getPassword());
            ps.executeUpdate();
        }
    }

    public List<Landlord> getAll() throws SQLException {
        List<Landlord> landlords = new ArrayList<>();
        String sql = "SELECT * FROM Landlords";
        try (Connection conn = DBConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Landlord l = new Landlord();
                l.setLandlordId(rs.getInt("landlord_id"));
                l.setFullName(rs.getString("full_name"));
                l.setPhone(rs.getString("phone"));
                l.setEmail(rs.getString("email"));
                l.setPassword(rs.getString("password"));
                l.setCreatedAt(rs.getTimestamp("created_at"));
                landlords.add(l);
            }
        }
        return landlords;
    }

    public Landlord getById(int id) throws SQLException {
        String sql = "SELECT * FROM Landlords WHERE landlord_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    Landlord l = new Landlord();
                    l.setLandlordId(rs.getInt("landlord_id"));
                    l.setFullName(rs.getString("full_name"));
                    l.setPhone(rs.getString("phone"));
                    l.setEmail(rs.getString("email"));
                    l.setPassword(rs.getString("password"));
                    l.setCreatedAt(rs.getTimestamp("created_at"));
                    return l;
                }
            }
        }
        return null;
    }

    public void update(Landlord landlord) throws SQLException {
        String sql = "UPDATE Landlords SET full_name = ?, phone = ?, email = ?, password = ? WHERE landlord_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, landlord.getFullName());
            ps.setString(2, landlord.getPhone());
            ps.setString(3, landlord.getEmail());
            ps.setString(4, landlord.getPassword());
            ps.setInt(5, landlord.getLandlordId());
            ps.executeUpdate();
        }
    }

    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM Landlords WHERE landlord_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }
}
