package com.example.rentalsystem.model;

import java.sql.Timestamp;

public class Customer {
    private int customerId;
    private String fullName;
    private String phone;
    private String email;
    private String password;
    private Timestamp createdAt;

    public Customer() {}

    public Customer(int customerId, String fullName, String phone, String email, String password, Timestamp createdAt) {
        this.customerId = customerId;
        this.fullName = fullName;
        this.phone = phone;
        this.email = email;
        this.password = password;
        this.createdAt = createdAt;
    }

    // Getters and Setters
    public int getCustomerId() { return customerId; }
    public void setCustomerId(int customerId) { this.customerId = customerId; }

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
