<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold m-0 text-uppercase">Property Listings</h2>
        <a href="<%= request.getContextPath() %>/properties?action=new" class="btn btn-success fw-bold px-4 shadow-sm">Add New Property</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Landlord ID</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <c:forEach var="property" items="${listProperty}">
                    <tr>
                        <td class="align-middle fw-bold"><c:out value="${property.propertyId}" /></td>
                        <td class="align-middle text-secondary"><c:out value="${property.landlordId}" /></td>
                        <td class="align-middle fw-semibold text-dark"><c:out value="${property.title}" /></td>
                        <td class="align-middle"><c:out value="${property.location}" /></td>
                        <td class="align-middle"><span class="badge bg-light text-dark shadow-sm">RWF <c:out value="${property.price}" /></span></td>
                        <td class="align-middle">
                            <c:set var="statusClass" value="${property.status == 'Available' ? 'bg-success' : 'bg-secondary'}" />
                            <span class="badge ${statusClass} shadow-sm"><c:out value="${property.status}" /></span>
                        </td>
                        <td class="align-middle">
                            <div class="btn-group shadow-sm">
                                <a href="<%= request.getContextPath() %>/properties?action=edit&id=<c:out value='${property.propertyId}' />" class="btn btn-primary btn-sm px-3">Edit</a>
                                <a href="<%= request.getContextPath() %>/properties?action=delete&id=<c:out value='${property.propertyId}' />" class="btn btn-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this property?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                </c:forEach>
            </tbody>
        </table>
    </div>

    <!-- Error/Success Messages -->
    <c:if test="${not empty errorMessage}">
        <div class="alert alert-danger mt-4"><c:out value="${errorMessage}" /></div>
    </c:if>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
