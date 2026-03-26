package com.example.rentalsystem;

import com.example.rentalsystem.dao.CustomerDAO;
import com.example.rentalsystem.model.Customer;
import java.util.List;

public class Main {
  public static void main(String[] args) {
    System.out.println("--- Testing MySQL Connection ---");
    CustomerDAO dao = new CustomerDAO();

    try {
      // 1. Get all customers from DB
      List<Customer> customers = dao.getAll();
      System.out.println("Total customers in DB: " + customers.size());

      for (Customer c : customers) {
        System.out.println("ID: " + c.getCustomerId() + " | Name: " + c.getFullName());
      }

      // 2. Try inserting a test customer
      Customer test = new Customer();
      test.setFullName("Test User");
      test.setPhone("0000000000");
      test.setPassword("test123");
      dao.insert(test);
      System.out.println("Successfully added a test customer!");

    } catch (Exception e) {
      System.err.println("Database Error: " + e.getMessage());
      e.printStackTrace();
    }
  }
}
