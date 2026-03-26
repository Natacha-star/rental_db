<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="mb-4 d-flex align-items-center">
        <a href="<%= request.getContextPath() %>/properties?action=list" class="btn btn-outline-secondary btn-sm me-3">&larr; Back</a>
        <h2 class="text-primary fw-bold m-0">
            <c:if test="${property != null}">Edit Property Details (ID: <c:out value='${property.propertyId}' />)</c:if>
            <c:if test="${property == null}">Create Property Listing</c:if>
        </h2>
    </div>

    <form action="<%= request.getContextPath() %>/properties?action=<c:if test='${property != null}'>update</c:if><c:if test='${property == null}'>insert</c:if>" method="post" class="card-body">
        
        <c:if test="${property != null}">
            <input type="hidden" name="id" value="<c:out value='${property.propertyId}' />" />
        </c:if>

        <div class="row g-4">
            <div class="col-md-4">
                <label for="landlordId" class="form-label fw-semibold">Associated Landlord ID</label>
                <input type="number" name="landlordId" class="form-control form-control-lg bg-light" value="<c:out value='${property.landlordId}' />" required placeholder="Owner ID">
            </div>
            <div class="col-md-8">
                <label for="title" class="form-label fw-semibold">Property Heading / Title</label>
                <input type="text" name="title" class="form-control form-control-lg bg-light" value="<c:out value='${property.title}' />" required placeholder="Listing title (e.g., Luxury Villa)">
            </div>
            <div class="col-md-12">
                <label for="description" class="form-label fw-semibold">Detailed Description</label>
                <textarea name="description" class="form-control bg-light" rows="3" placeholder="Features, rooms, amenities..."><c:out value='${property.description}' /></textarea>
            </div>
            <div class="col-md-4">
                <label for="location" class="form-label fw-semibold">Property Location</label>
                <input type="text" name="location" class="form-control form-control-lg bg-light" value="<c:out value='${property.location}' />" required placeholder="Address or Neighborhood">
            </div>
            <div class="col-md-4">
                <label for="price" class="form-label fw-semibold">Requested Monthly Price</label>
                <div class="input-group">
                    <span class="input-group-text fw-bold">RWF</span>
                    <input type="number" step="0.01" name="price" class="form-control form-control-lg bg-light" value="<c:out value='${property.price}' />" required placeholder="0.00">
                </div>
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label fw-semibold">Current Listing Status</label>
                <select name="status" class="form-select form-select-lg bg-white border" required>
                    <option value="Available" <c:if test="${property.status == 'Available'}">selected</c:if>>Available for rent</option>
                    <option value="Rented" <c:if test="${property.status == 'Rented'}">selected</c:if>>Currently Rented</option>
                </select>
            </div>
        </div>

        <div class="mt-5 d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-light px-5 fw-bold">Discard Changes</button>
            <button type="submit" class="btn btn-primary px-5 fw-bold shadow">Publish Property Listing</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
