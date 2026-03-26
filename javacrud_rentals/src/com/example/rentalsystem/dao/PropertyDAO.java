package com.example.rentalsystem.dao;

import com.example.rentalsystem.model.Property;
import com.example.rentalsystem.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class PropertyDAO {

    public void insert(Property property) throws SQLException {
        String sql = "INSERT INTO Properties (landlord_id, title, description, location, price, status) VALUES (?, ?, ?, ?, ?, ?)";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, property.getLandlordId());
            ps.setString(2, property.getTitle());
            ps.setString(3, property.getDescription());
            ps.setString(4, property.getLocation());
            ps.setBigDecimal(5, property.getPrice());
            ps.setString(6, property.getStatus());
            ps.executeUpdate();
        }
    }

    public List<Property> getAll() throws SQLException {
        List<Property> properties = new ArrayList<>();
        String sql = "SELECT * FROM Properties";
        try (Connection conn = DBConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Property p = new Property();
                p.setPropertyId(rs.getInt("property_id"));
                p.setLandlordId(rs.getInt("landlord_id"));
                p.setTitle(rs.getString("title"));
                p.setDescription(rs.getString("description"));
                p.setLocation(rs.getString("location"));
                p.setPrice(rs.getBigDecimal("price"));
                p.setStatus(rs.getString("status"));
                p.setCreatedAt(rs.getTimestamp("created_at"));
                properties.add(p);
            }
        }
        return properties;
    }

    public Property getById(int id) throws SQLException {
        String sql = "SELECT * FROM Properties WHERE property_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    Property p = new Property();
                    p.setPropertyId(rs.getInt("property_id"));
                    p.setLandlordId(rs.getInt("landlord_id"));
                    p.setTitle(rs.getString("title"));
                    p.setDescription(rs.getString("description"));
                    p.setLocation(rs.getString("location"));
                    p.setPrice(rs.getBigDecimal("price"));
                    p.setStatus(rs.getString("status"));
                    p.setCreatedAt(rs.getTimestamp("created_at"));
                    return p;
                }
            }
        }
        return null;
    }

    public void update(Property property) throws SQLException {
        String sql = "UPDATE Properties SET landlord_id = ?, title = ?, description = ?, location = ?, price = ?, status = ? WHERE property_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, property.getLandlordId());
            ps.setString(2, property.getTitle());
            ps.setString(3, property.getDescription());
            ps.setString(4, property.getLocation());
            ps.setBigDecimal(5, property.getPrice());
            ps.setString(6, property.getStatus());
            ps.setInt(7, property.getPropertyId());
            ps.executeUpdate();
        }
    }

    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM Properties WHERE property_id = ?";
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }
}
