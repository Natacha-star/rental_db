<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="mb-4 d-flex align-items-center">
        <a href="<%= request.getContextPath() %>/rentals?action=list" class="btn btn-outline-secondary btn-sm me-3">&larr; Back</a>
        <h2 class="text-primary fw-bold m-0">
            <c:if test="${rental != null}">Edit Rental Agreement (ID: <c:out value='${rental.rentalId}' />)</c:if>
            <c:if test="${rental == null}">Open New Rental Agreement</c:if>
        </h2>
    </div>

    <form action="<%= request.getContextPath() %>/rentals?action=<c:if test='${rental != null}'>update</c:if><c:if test='${rental == null}'>insert</c:if>" method="post" class="card-body">
        
        <c:if test="${rental != null}">
            <input type="hidden" name="id" value="<c:out value='${rental.rentalId}' />" />
        </c:if>

        <div class="row g-4">
            <div class="col-md-6">
                <label for="propertyId" class="form-label fw-semibold">Target Property ID</label>
                <input type="number" name="propertyId" class="form-control form-control-lg bg-light" value="<c:out value='${rental.propertyId}' />" required placeholder="Listing ID Number">
            </div>
            <div class="col-md-6">
                <label for="customerId" class="form-label fw-semibold">Target Customer ID</label>
                <input type="number" name="customerId" class="form-control form-control-lg bg-light" value="<c:out value='${rental.customerId}' />" required placeholder="User/Client ID Number">
            </div>
            <div class="col-md-6">
                <label for="startDate" class="form-label fw-semibold">Agreement Start Date</label>
                <input type="date" name="startDate" class="form-control form-control-lg bg-light" value="<c:out value='${rental.startDate}' />" required>
            </div>
            <div class="col-md-6">
                <label for="endDate" class="form-label fw-semibold">Agreement End Date</label>
                <input type="date" name="endDate" class="form-control form-control-lg bg-light" value="<c:out value='${rental.endDate}' />">
                <small class="text-secondary opacity-75">Leave empty if indefinite agreement</small>
            </div>
            <div class="col-md-12">
                <label for="paymentStatus" class="form-label fw-semibold">Initial Payment Status</label>
                <select name="paymentStatus" class="form-select form-select-lg bg-white border" required>
                    <option value="Paid" <c:if test="${rental.paymentStatus == 'Paid'}">selected</c:if>>Fully Paid / Receipted</option>
                    <option value="Pending" <c:if test="${rental.paymentStatus == 'Pending'}">selected</c:if>>Payment Pending / Outstanding</option>
                </select>
            </div>
        </div>

        <div class="mt-5 d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-light px-5 fw-bold">Wipe Changes</button>
            <button type="submit" class="btn btn-primary px-5 fw-bold shadow">Save Rental Agreement</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
