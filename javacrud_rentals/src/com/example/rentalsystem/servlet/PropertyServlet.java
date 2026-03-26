package com.example.rentalsystem.servlet;

import com.example.rentalsystem.dao.PropertyDAO;
import com.example.rentalsystem.model.Property;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.math.BigDecimal;
import java.sql.SQLException;
import java.util.List;

@WebServlet("/properties")
public class PropertyServlet extends HttpServlet {
    private PropertyDAO propertyDAO;

    public void init() {
        propertyDAO = new PropertyDAO();
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
                    insertProperty(request, response);
                    break;
                case "delete":
                    deleteProperty(request, response);
                    break;
                case "edit":
                    showEditForm(request, response);
                    break;
                case "update":
                    updateProperty(request, response);
                    break;
                default:
                    listProperties(request, response);
                    break;
            }
        } catch (SQLException ex) {
            throw new ServletException(ex);
        }
    }

    private void listProperties(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException, ServletException {
        List<Property> listProperty = propertyDAO.getAll();
        request.setAttribute("listProperty", listProperty);
        request.getRequestDispatcher("properties/list.jsp").forward(request, response);
    }

    private void showNewForm(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        request.getRequestDispatcher("properties/form.jsp").forward(request, response);
    }

    private void showEditForm(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        Property existingProperty = propertyDAO.getById(id);
        request.setAttribute("property", existingProperty);
        request.getRequestDispatcher("properties/form.jsp").forward(request, response);
    }

    private void insertProperty(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int landlordId = Integer.parseInt(request.getParameter("landlordId"));
        String title = request.getParameter("title");
        String description = request.getParameter("description");
        String location = request.getParameter("location");
        BigDecimal price = new BigDecimal(request.getParameter("price"));
        String status = request.getParameter("status");

        Property newProperty = new Property();
        newProperty.setLandlordId(landlordId);
        newProperty.setTitle(title);
        newProperty.setDescription(description);
        newProperty.setLocation(location);
        newProperty.setPrice(price);
        newProperty.setStatus(status);
        
        propertyDAO.insert(newProperty);
        response.sendRedirect("properties?action=list");
    }

    private void updateProperty(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        int landlordId = Integer.parseInt(request.getParameter("landlordId"));
        String title = request.getParameter("title");
        String description = request.getParameter("description");
        String location = request.getParameter("location");
        BigDecimal price = new BigDecimal(request.getParameter("price"));
        String status = request.getParameter("status");

        Property property = new Property();
        property.setPropertyId(id);
        property.setLandlordId(landlordId);
        property.setTitle(title);
        property.setDescription(description);
        property.setLocation(location);
        property.setPrice(price);
        property.setStatus(status);

        propertyDAO.update(property);
        response.sendRedirect("properties?action=list");
    }

    private void deleteProperty(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        int id = Integer.parseInt(request.getParameter("id"));
        propertyDAO.delete(id);
        response.sendRedirect("properties?action=list");
    }
}
