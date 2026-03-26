package com.example.rentalsystem.servlet;

import com.example.rentalsystem.dao.LandlordDAO;
import com.example.rentalsystem.model.Landlord;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.SQLException;
import java.util.List;

@WebServlet("/landlords")
public class LandlordServlet extends HttpServlet {
    private LandlordDAO landlordDAO;

    public void init() {
        landlordDAO = new LandlordDAO();
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
                    insertLandlord(request, response);
                    break;
                case "delete":
                    deleteLandlord(request, response);
                    break;
                case "edit":
                    showEditForm(request, response);
                    break;
                case "update":
                    updateLandlord(request, response);
                    break;
                default:
                    listLandlords(request, response);
                    break;
            }
        } catch (SQLException ex) {
            throw new ServletException(ex);
        }
    }

    private void listLandlords(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException, ServletException {
        List<Landlord> listLandlord = landlordDAO.getAll();
        request.setAttribute("listLandlord", listLandlord);
        request.getRequestDispatcher("landlords/list.jsp").forward(request, response);
    }

    private void showNewForm(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        request.getRequestDispatcher("landlords/form.jsp").forward(request, response);
    }

    private void showEditForm(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        Landlord existingLandlord = landlordDAO.getById(id);
        request.setAttribute("landlord", existingLandlord);
        request.getRequestDispatcher("landlords/form.jsp").forward(request, response);
    }

    private void insertLandlord(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int landlordId = Integer.parseInt(request.getParameter("landlordId"));
        String fullName = request.getParameter("fullName");
        String phone = request.getParameter("phone");
        String email = request.getParameter("email");
        String password = request.getParameter("password");

        Landlord newLandlord = new Landlord();
        newLandlord.setLandlordId(landlordId);
        newLandlord.setFullName(fullName);
        newLandlord.setPhone(phone);
        newLandlord.setEmail(email);
        newLandlord.setPassword(password);
        
        landlordDAO.insert(newLandlord);
        response.sendRedirect("landlords?action=list");
    }

    private void updateLandlord(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        String fullName = request.getParameter("fullName");
        String phone = request.getParameter("phone");
        String email = request.getParameter("email");
        String password = request.getParameter("password");

        Landlord landlord = new Landlord();
        landlord.setLandlordId(id);
        landlord.setFullName(fullName);
        landlord.setPhone(phone);
        landlord.setEmail(email);
        landlord.setPassword(password);

        landlordDAO.update(landlord);
        response.sendRedirect("landlords?action=list");
    }

    private void deleteLandlord(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        landlordDAO.delete(id);
        response.sendRedirect("landlords?action=list");
    }
}
