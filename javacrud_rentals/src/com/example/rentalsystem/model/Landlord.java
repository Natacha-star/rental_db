package com.example.rentalsystem.model;

import java.sql.Timestamp;

public class Landlord {
    private int landlordId;
    private String fullName;
    private String phone;
    private String email;
    private String password;
    private Timestamp createdAt;

    public Landlord() {}

    public Landlord(int landlordId, String fullName, String phone, String email, String password, Timestamp createdAt) {
        this.landlordId = landlordId;
        this.fullName = fullName;
        this.phone = phone;
        this.email = email;
        this.password = password;
        this.createdAt = createdAt;
    }

    // Getters and Setters
    public int getLandlordId() { return landlordId; }
    public void setLandlordId(int landlordId) { this.landlordId = landlordId; }

    public String getFullName() { return fullName; }
    public void setFullName(String fullName) { this.fullName = fullName; }

    public String getPhone() { return phone; }
    public void setPhone(String phone) { this.phone = phone; }

    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }

    public String getPassword() { return password; }
    public void setPassword(String password) { this.password = password; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }
}
