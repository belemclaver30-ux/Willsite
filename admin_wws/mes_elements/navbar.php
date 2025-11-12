<nav
  class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
  <div class="container-fluid">
    <nav
      class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
    </nav>

    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">




      <li class="nav-item topbar-user dropdown hidden-caret">
        <a
          class="dropdown-toggle profile-pic"
          data-bs-toggle="dropdown"
          href="#"
          aria-expanded="false">
          <div class="avatar-sm">
            <img
              src="../assets/img/team8.jpg"
              alt="..."
              class="avatar-img rounded-circle" />
          </div>
          <span class="profile-username">
            <span class="fw-bold">
            <?php 
              $nom = $_SESSION['nom'];
              echo $nom;
              ?></span> <br>
            <span class="op-7">
              <?php
              $statut = $_SESSION['statut'];
              echo $statut;
              ?></span>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-user animated fadeIn">
          <div class="dropdown-user-scroll scrollbar-outer">
            <li>
              <div class="user-box">
                <div class="avatar-lg">
                  <img
                    src="assets/img/profile-icon.htm"
                    alt="image profile"
                    class="avatar-img rounded" />
                </div>
                <div class="u-text">
                  <h4>Wilfried</h4>
                  <p class="text-muted">hello@example.com</p>
                  <a
                    href="profile.html"
                    class="btn btn-xs btn-secondary btn-sm">Mon profile</a>
                </div>
              </div>
            </li>
            <li>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">My Profile</a>
              <a class="dropdown-item" href="#">My Balance</a>
              <a class="dropdown-item" href="#">Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Account Setting</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Logout</a>
            </li>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</nav>