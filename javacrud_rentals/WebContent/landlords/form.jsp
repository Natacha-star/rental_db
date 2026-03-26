<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="mb-4 d-flex align-items-center">
        <a href="<%= request.getContextPath() %>/landlords?action=list" class="btn btn-outline-secondary btn-sm me-3">&larr; Back</a>
        <h2 class="text-primary fw-bold m-0">
            <c:if test="${landlord != null}">Edit Landlord Profile (ID: <c:out value='${landlord.landlordId}' />)</c:if>
            <c:if test="${landlord == null}">Register New Landlord</c:if>
        </h2>
    </div>

    <form action="<%= request.getContextPath() %>/landlords?action=<c:if test='${landlord != null}'>update</c:if><c:if test='${landlord == null}'>insert</c:if>" method="post" class="card-body">
        
        <c:if test="${landlord != null}">
            <input type="hidden" name="id" value="<c:out value='${landlord.landlordId}' />" />
        </c:if>

        <div class="row g-4">
            <c:if test="${landlord == null}">
                <div class="col-md-12">
                    <label for="landlordId" class="form-label fw-semibold">Assigned Landlord ID</label>
                    <input type="number" name="landlordId" class="form-control form-control-lg bg-light" required placeholder="User-defined numeric ID (e.g., 21)">
                </div>
            </c:if>
            <div class="col-md-6">
                <label for="fullName" class="form-label fw-semibold">Legal Full Name</label>
                <input type="text" name="fullName" class="form-control form-control-lg bg-light" value="<c:out value='${landlord.fullName}' />" required placeholder="Owner's full legal name">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label fw-semibold">Mobile Phone</label>
                <input type="text" name="phone" class="form-control form-control-lg bg-light" value="<c:out value='${landlord.phone}' />" required placeholder="Contact phone number">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg bg-light" value="<c:out value='${landlord.email}' />" placeholder="landlord@email.com">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label fw-semibold">Login Password</label>
                <input type="password" name="password" class="form-control form-control-lg bg-light" value="<c:out value='${landlord.password}' />" required placeholder="Secure login password">
            </div>
        </div>

        <div class="mt-5 d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-light px-5 fw-bold">Clear All</button>
            <button type="submit" class="btn btn-primary px-5 fw-bold shadow">Save Landlord Info</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
