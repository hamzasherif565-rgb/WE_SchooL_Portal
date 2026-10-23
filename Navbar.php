
<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>
    .custom-navbar {
        background: #20243a;
        padding: 14px 0;
        box-shadow: 0 4px 20px rgba(30, 35, 70, 0.08);
    }

    .custom-navbar .navbar-brand {
        font-size: 21px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #ffffff;
    }

    .custom-navbar .navbar-brand:hover {
        color: #b9b5ff;
    }

    .custom-navbar .nav-link {
        color: #c3c7d8;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 15px;
        margin-left: 5px;
        border-radius: 9px;
        transition: all 0.2s ease;
    }

    .custom-navbar .nav-link:hover,
    .custom-navbar .nav-link.active {
        color: #ffffff;
        background: rgba(99, 91, 255, 0.2);
    }

    .custom-navbar .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.25);
    }

    .custom-navbar .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(99, 91, 255, 0.3);
    }

    .brand-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        margin-right: 9px;
        border-radius: 10px;
        background: #635bff;
        color: white;
        font-size: 16px;
        vertical-align: middle;
    }

    @media (max-width: 991px) {
        .custom-navbar .navbar-nav {
            padding-top: 15px;
        }

        .custom-navbar .nav-link {
            margin: 3px 0;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">

        <a class="navbar-brand" href="index.php">
            <span class="brand-icon">W</span>WE Student Portal
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav ms-auto">

                <a class="nav-link" href="student.php">
                    Student Check
                </a>

                <a class="nav-link" href="index.php">
                    Dashboard (Admin)
                </a>

            </div>
        </div>

    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
