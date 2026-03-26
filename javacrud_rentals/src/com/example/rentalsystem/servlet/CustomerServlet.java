package com.example.rentalsystem.servlet;

import com.example.rentalsystem.dao.CustomerDAO;
import com.example.rentalsystem.model.Customer;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.SQLException;
import java.util.List;

@WebServlet("/customers")
public class CustomerServlet extends HttpServlet {
    private CustomerDAO customerDAO;

    public void init() {
        customerDAO = new CustomerDAO();
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
                    insertCustomer(request, response);
                    break;
                case "delete":
                    deleteCustomer(request, response);
                    break;
                case "edit":
                    showEditForm(request, response);
                    break;
                case "update":
                    updateCustomer(request, response);
                    break;
                default:
                    listCustomers(request, response);
                    break;
            }
        } catch (SQLException ex) {
            throw new ServletException(ex);
        }
    }

    private void listCustomers(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException, ServletException {
        List<Customer> listCustomer = customerDAO.getAll();
        request.setAttribute("listCustomer", listCustomer);
        request.getRequestDispatcher("customers/list.jsp").forward(request, response);
    }

    private void showNewForm(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        request.getRequestDispatcher("customers/form.jsp").forward(request, response);
    }

    private void showEditForm(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        Customer existingCustomer = customerDAO.getById(id);
        request.setAttribute("customer", existingCustomer);
        request.getRequestDispatcher("customers/form.jsp").forward(request, response);
    }

    private void insertCustomer(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        String fullName = request.getParameter("fullName");
        String phone = request.getParameter("phone");
        String email = request.getParameter("email");
        String password = request.getParameter("password");

        Customer newCustomer = new Customer();
        newCustomer.setFullName(fullName);
        newCustomer.setPhone(phone);
        newCustomer.setEmail(email);
        newCustomer.setPassword(password);
        
        customerDAO.insert(newCustomer);
        response.sendRedirect("customers?action=list");
    }

    private void updateCustomer(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        String fullName = request.getParameter("fullName");
        String phone = request.getParameter("phone");
        String email = request.getParameter("email");
        String password = request.getParameter("password");

        Customer customer = new Customer();
        customer.setCustomerId(id);
        customer.setFullName(fullName);
        customer.setPhone(phone);
        customer.setEmail(email);
        customer.setPassword(password);

        customerDAO.update(customer);
        response.sendRedirect("customers?action=list");
    }

    private void deleteCustomer(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        customerDAO.delete(id);
        response.sendRedirect("customers?action=list");
    }
}
