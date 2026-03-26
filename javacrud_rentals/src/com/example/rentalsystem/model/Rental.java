package com.example.rentalsystem.model;

import java.sql.Date;

public class Rental {
    private int rentalId;
    private int propertyId;
    private int customerId;
    private Date startDate;
    private Date endDate;
    private String paymentStatus;

    public Rental() {}

    public Rental(int rentalId, int propertyId, int customerId, Date startDate, Date endDate, String paymentStatus) {
        this.rentalId = rentalId;
        this.propertyId = propertyId;
        this.customerId = customerId;
        this.startDate = startDate;
        this.endDate = endDate;
        this.paymentStatus = paymentStatus;
    }

    // Getters and Setters
    public int getRentalId() { return rentalId; }
    public void setRentalId(int rentalId) { this.rentalId = rentalId; }

    public int getPropertyId() { return propertyId; }
    public void setPropertyId(int propertyId) { this.propertyId = propertyId; }

    public int getCustomerId() { return customerId; }
    public void setCustomerId(int customerId) { this.customerId = customerId; }

    public Date getStartDate() { return startDate; }
    public void setStartDate(Date startDate) { this.startDate = startDate; }

    public Date getEndDate() { return endDate; }
    public void setEndDate(Date endDate) { this.endDate = endDate; }

    public String getPaymentStatus() { return paymentStatus; }
    public void setPaymentStatus(String paymentStatus) { this.paymentStatus = paymentStatus; }
}
