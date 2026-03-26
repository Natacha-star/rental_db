package com.example.rentalsystem.model;

import java.sql.Timestamp;
import java.math.BigDecimal;

public class Property {
    private int propertyId;
    private int landlordId;
    private String title;
    private String description;
    private String location;
    private BigDecimal price;
    private String status;
    private Timestamp createdAt;

    public Property() {}

    public Property(int propertyId, int landlordId, String title, String description, String location, BigDecimal price, String status, Timestamp createdAt) {
        this.propertyId = propertyId;
        this.landlordId = landlordId;
        this.title = title;
        this.description = description;
        this.location = location;
        this.price = price;
        this.status = status;
        this.createdAt = createdAt;
    }

    // Getters and Setters
    public int getPropertyId() { return propertyId; }
    public void setPropertyId(int propertyId) { this.propertyId = propertyId; }

    public int getLandlordId() { return landlordId; }
    public void setLandlordId(int landlordId) { this.landlordId = landlordId; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getLocation() { return location; }
    public void setLocation(String location) { this.location = location; }

    public BigDecimal getPrice() { return price; }
    public void setPrice(BigDecimal price) { this.price = price; }

    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }
}
