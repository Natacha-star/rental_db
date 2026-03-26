package com.example.rentalsystem.servlet;

import com.example.rentalsystem.dao.RentalDAO;
import com.example.rentalsystem.model.Rental;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.Date;
import java.sql.SQLException;
import java.util.List;

@WebServlet("/rentals")
public class RentalServlet extends HttpServlet {
    private RentalDAO rentalDAO;

    public void init() {
        rentalDAO = new RentalDAO();
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        doGet(request, response);
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String action = request.getParameter("action");
        if (action == null) {
            action = "list";
        }

        try {
            switch (action) {
                case "new":
                    showNewForm(request, response);
                    break;
                case "insert":
                    insertRental(request, response);
                    break;
                case "delete":
                    deleteRental(request, response);
                    break;
                case "edit":
                    showEditForm(request, response);
                    break;
                case "update":
                    updateRental(request, response);
                    break;
                default:
                    listRentals(request, response);
                    break;
            }
        } catch (SQLException ex) {
            throw new ServletException(ex);
        }
    }

    private void listRentals(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException, ServletException {
        List<Rental> listRental = rentalDAO.getAll();
        request.setAttribute("listRental", listRental);
        request.getRequestDispatcher("rentals/list.jsp").forward(request, response);
    }

    private void showNewForm(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        request.getRequestDispatcher("rentals/form.jsp").forward(request, response);
    }

    private void showEditForm(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        Rental existingRental = rentalDAO.getById(id);
        request.setAttribute("rental", existingRental);
        request.getRequestDispatcher("rentals/form.jsp").forward(request, response);
    }

    private void insertRental(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int propertyId = Integer.parseInt(request.getParameter("propertyId"));
        int customerId = Integer.parseInt(request.getParameter("customerId"));
        Date startDate = Date.valueOf(request.getParameter("startDate"));
        String endDateStr = request.getParameter("endDate");
        Date endDate = (endDateStr != null && !endDateStr.isEmpty()) ? Date.valueOf(endDateStr) : null;
        String paymentStatus = request.getParameter("paymentStatus");

        Rental newRental = new Rental();
        newRental.setPropertyId(propertyId);
        newRental.setCustomerId(customerId);
        newRental.setStartDate(startDate);
        newRental.setEndDate(endDate);
        newRental.setPaymentStatus(paymentStatus);
        
        rentalDAO.insert(newRental);
        response.sendRedirect("rentals?action=list");
    }

    private void updateRental(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        int propertyId = Integer.parseInt(request.getParameter("propertyId"));
        int customerId = Integer.parseInt(request.getParameter("customerId"));
        Date startDate = Date.valueOf(request.getParameter("startDate"));
        String endDateStr = request.getParameter("endDate");
        Date endDate = (endDateStr != null && !endDateStr.isEmpty()) ? Date.valueOf(endDateStr) : null;
        String paymentStatus = request.getParameter("paymentStatus");

        Rental rental = new Rental();
        rental.setRentalId(id);
        rental.setPropertyId(propertyId);
        rental.setCustomerId(customerId);
        rental.setStartDate(startDate);
        rental.setEndDate(endDate);
        rental.setPaymentStatus(paymentStatus);

        rentalDAO.update(rental);
        response.sendRedirect("rentals?action=list");
    }

    private void deleteRental(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        rentalDAO.delete(id);
        response.sendRedirect("rentals?action=list");
    }
}
