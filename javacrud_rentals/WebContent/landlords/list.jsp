<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<jsp:include page="../header.jsp" />

<div class="container bg-white p-5 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold m-0 text-uppercase">Landlord Directory</h2>
        <a href="<%= request.getContextPath() %>/landlords?action=new" class="btn btn-success fw-bold px-4 shadow-sm">Add New Landlord</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <c:forEach var="landlord" items="${listLandlord}">
                    <tr>
                        <td class="align-middle fw-bold"><c:out value="${landlord.landlordId}" /></td>
                        <td class="align-middle"><c:out value="${landlord.fullName}" /></td>
                        <td class="align-middle"><c:out value="${landlord.phone}" /></td>
                        <td class="align-middle"><c:out value="${landlord.email}" /></td>
                        <td class="align-middle"><c:out value="${landlord.createdAt}" /></td>
                        <td class="align-middle">
                            <div class="btn-group shadow-sm">
                                <a href="<%= request.getContextPath() %>/landlords?action=edit&id=<c:out value='${landlord.landlordId}' />" class="btn btn-primary btn-sm px-3">Edit</a>
                                <a href="<%= request.getContextPath() %>/landlords?action=delete&id=<c:out value='${landlord.landlordId}' />" class="btn btn-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this landlord?')">Delete</a>
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
