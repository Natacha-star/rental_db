<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="mb-4 d-flex align-items-center">
        <a href="<%= request.getContextPath() %>/customers?action=list" class="btn btn-outline-secondary btn-sm me-3">&larr; Back</a>
        <h2 class="text-primary fw-bold m-0">
            <c:if test="${customer != null}">Edit Customer (ID: <c:out value='${customer.customerId}' />)</c:if>
            <c:if test="${customer == null}">Add New Customer</c:if>
        </h2>
    </div>

    <form action="<%= request.getContextPath() %>/customers?action=<c:if test='${customer != null}'>update</c:if><c:if test='${customer == null}'>insert</c:if>" method="post" class="card-body">
        
        <c:if test="${customer != null}">
            <input type="hidden" name="id" value="<c:out value='${customer.customerId}' />" />
        </c:if>

        <div class="row g-4">
            <div class="col-md-6">
                <label for="fullName" class="form-label fw-semibold">Full Name</label>
                <input type="text" name="fullName" class="form-control form-control-lg bg-light" value="<c:out value='${customer.fullName}' />" required placeholder="Enter customer's full name">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                <input type="text" name="phone" class="form-control form-control-lg bg-light" value="<c:out value='${customer.phone}' />" required placeholder="example: 078xxxxxxx">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">Email Address (Optional)</label>
                <input type="email" name="email" class="form-control form-control-lg bg-light" value="<c:out value='${customer.email}' />" placeholder="customer@email.com">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control form-control-lg bg-light" value="<c:out value='${customer.password}' />" required placeholder="Enter login password">
            </div>
        </div>

        <div class="mt-5 d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-light px-5 fw-bold">Reset Form</button>
            <button type="submit" class="btn btn-primary px-5 fw-bold shadow">Save Customer Details</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
