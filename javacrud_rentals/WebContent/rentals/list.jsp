<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold m-0 text-uppercase">Rental Transactions</h2>
        <a href="<%= request.getContextPath() %>/rentals?action=new" class="btn btn-success fw-bold px-4 shadow-sm">Record New Rental Operation</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Rental ID</th>
                    <th>Property ID</th>
                    <th>Customer ID</th>
                    <th>Agreement Start</th>
                    <th>Agreement End</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <c:forEach var="rental" items="${listRental}">
                    <tr>
                        <td class="align-middle fw-bold"><c:out value="${rental.rentalId}" /></td>
                        <td class="align-middle"><c:out value="${rental.propertyId}" /></td>
                        <td class="align-middle"><c:out value="${rental.customerId}" /></td>
                        <td class="align-middle fw-semibold"><c:out value="${rental.startDate}" /></td>
                        <td class="align-middle"><c:out value="${rental.endDate}" /></td>
                        <td class="align-middle">
                            <c:set var="payStatusClass" value="${rental.paymentStatus == 'Paid' ? 'bg-success' : 'bg-warning text-dark'}" />
                            <span class="badge ${payStatusClass} shadow-sm px-3"><c:out value="${rental.paymentStatus}" /></span>
                        </td>
                        <td class="align-middle text-nowrap">
                            <div class="btn-group shadow-sm">
                                <a href="<%= request.getContextPath() %>/rentals?action=edit&id=<c:out value='${rental.rentalId}' />" class="btn btn-primary btn-sm px-3">Edit</a>
                                <a href="<%= request.getContextPath() %>/rentals?action=delete&id=<c:out value='${rental.rentalId}' />" class="btn btn-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this rental record?')">Delete</a>
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
