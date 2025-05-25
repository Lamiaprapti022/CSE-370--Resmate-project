<style>
  .toggle-btn-container {
    height: 18px;
    width: 18px;
    border-radius: 10px;
    opacity: 0.6;
  }

  .btn-container-cls {
    position: absolute;
    left: 83%;
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.21);
    padding: 4px;
    border-radius: 50%;
  }

  .rotate {
    rotate: 180deg;
  }
</style>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
  <!-- Sidebar header -->
  <div class="sidebar-header">
    <div class="sidebar-logo">
      <a><img src="images/resmate_logo.png" alt="ResMate Logo" class="sidebar-logo-img" /></a>
      <span class="sidebar-logo-text">ResMate</span>
    </div>

    <button onclick=toggleBtn() id="toggle-btn" class="btn-container-cls"><img class="toggle-btn-container" src="images/double-arrow-right-svgrepo-com.svg" alt=""></button>
  </div>

  <!-- Sidebar content -->
  <div class="sidebar-content">
    <nav class="sidebar-nav">
      <!-- Dashboard -->
      <a href="home_user.php" class="sidebar-nav-item sidebar-nav-item-current">
        <svg class="sidebar-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3103 1.77586C11.6966 1.40805 12.3034 1.40805 12.6897 1.77586L20.6897 9.39491L23.1897 11.7759C23.5896 12.1567 23.605 12.7897 23.2241 13.1897C22.8433 13.5896 22.2103 13.605 21.8103 13.2241L21 12.4524V20C21 21.1046 20.1046 22 19 22H14H10H5C3.89543 22 3 21.1046 3 20V12.4524L2.18966 13.2241C1.78972 13.605 1.15675 13.5896 0.775862 13.1897C0.394976 12.7897 0.410414 12.1567 0.810345 11.7759L3.31034 9.39491L11.3103 1.77586ZM5 10.5476V20H9V15C9 13.3431 10.3431 12 12 12C13.6569 12 15 13.3431 15 15V20H19V10.5476L12 3.88095L5 10.5476ZM13 20V15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15V20H13Z" fill="#000000" />
        </svg>
        <span class="sidebar-nav-text">Dashboard</span>
      </a>

      <!--Profile  -->
      <a href="profile.php" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 14.9 3.25 17.51 5.23 19.34C5.23 19.35 5.23 19.35 5.22 19.36C5.32 19.46 5.44 19.54 5.54 19.63C5.6 19.68 5.65 19.73 5.71 19.77C5.89 19.92 6.09 20.06 6.28 20.2C6.35 20.25 6.41 20.29 6.48 20.34C6.67 20.47 6.87 20.59 7.08 20.7C7.15 20.74 7.23 20.79 7.3 20.83C7.5 20.94 7.71 21.04 7.93 21.13C8.01 21.17 8.09 21.21 8.17 21.24C8.39 21.33 8.61 21.41 8.83 21.48C8.91 21.51 8.99 21.54 9.07 21.56C9.31 21.63 9.55 21.69 9.79 21.75C9.86 21.77 9.93 21.79 10.01 21.8C10.29 21.86 10.57 21.9 10.86 21.93C10.9 21.93 10.94 21.94 10.98 21.95C11.32 21.98 11.66 22 12 22C12.34 22 12.68 21.98 13.01 21.95C13.05 21.95 13.09 21.94 13.13 21.93C13.42 21.9 13.7 21.86 13.98 21.8C14.05 21.79 14.12 21.76 14.2 21.75C14.44 21.69 14.69 21.64 14.92 21.56C15 21.53 15.08 21.5 15.16 21.48C15.38 21.4 15.61 21.33 15.82 21.24C15.9 21.21 15.98 21.17 16.06 21.13C16.27 21.04 16.48 20.94 16.69 20.83C16.77 20.79 16.84 20.74 16.91 20.7C17.11 20.58 17.31 20.47 17.51 20.34C17.58 20.3 17.64 20.25 17.71 20.2C17.91 20.06 18.1 19.92 18.28 19.77C18.34 19.72 18.39 19.67 18.45 19.63C18.56 19.54 18.67 19.45 18.77 19.36C18.77 19.35 18.77 19.35 18.76 19.34C20.75 17.51 22 14.9 22 12ZM16.94 16.97C14.23 15.15 9.79 15.15 7.06 16.97C6.62 17.26 6.26 17.6 5.96 17.97C4.44 16.43 3.5 14.32 3.5 12C3.5 7.31 7.31 3.5 12 3.5C16.69 3.5 20.5 7.31 20.5 12C20.5 14.32 19.56 16.43 18.04 17.97C17.75 17.6 17.38 17.26 16.94 16.97Z" fill="#292D32" />
          <path d="M12 6.92969C9.93 6.92969 8.25 8.60969 8.25 10.6797C8.25 12.7097 9.84 14.3597 11.95 14.4197C11.98 14.4197 12.02 14.4197 12.04 14.4197C12.06 14.4197 12.09 14.4197 12.11 14.4197C12.12 14.4197 12.13 14.4197 12.13 14.4197C14.15 14.3497 15.74 12.7097 15.75 10.6797C15.75 8.60969 14.07 6.92969 12 6.92969Z" fill="#292D32" />
        </svg>
        <span class="sidebar-nav-text">Profile</span>
      </a>

      <!-- Post-->
      <a href="post.php" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="Edit / Add_Plus_Circle">
            <path id="Vector" d="M8 12H12M12 12H16M12 12V16M12 12V8M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </g>
        </svg>
        <span class="sidebar-nav-text">Post</span>
      </a>

      <!-- Discover -->
      <!-- <a href="#" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="sidebar-nav-text">Discover</span>
      </a> -->

      <!-- Connections -->
      <a href="inbox.php" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" transform="rotate(0)">
          <g id="SVGRepo_bgCarrier" stroke-width="0" />
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192" />
          <g id="SVGRepo_iconCarrier">
            <path d="M17 10H20M23 10H20M20 10V7M20 10V13" stroke="#000000" stroke-width="1.9919999999999998" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M1 20V19C1 15.134 4.13401 12 8 12V12C11.866 12 15 15.134 15 19V20" stroke="#000000" stroke-width="1.9919999999999998" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12Z" stroke="#000000" stroke-width="1.9919999999999998" stroke-linecap="round" stroke-linejoin="round" />
          </g>
        </svg>
        <span class="sidebar-nav-text">Connections</span>
      </a>


      <!-- Complaints -->
      <a href="#" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 32 32" id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" stroke-width="0.576">
          <g id="SVGRepo_bgCarrier" stroke-width="0" />
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
          <g id="SVGRepo_iconCarrier">
            <defs id="defs2" />
            <g id="layer1" transform="translate(-108,-388)">
              <path d="m 115,408.01367 c -2.7527,0 -5,2.2473 -5,5 0,2.7527 2.2473,5 5,5 h 14 c 2.7527,0 5,-2.2473 5,-5 0,-2.7527 -2.2473,-5 -5,-5 z m 0,2 h 14 c 1.6793,0 3,1.32071 3,3 0,1.6793 -1.3207,3 -3,3 h -14 c -1.6793,0 -3,-1.3207 -3,-3 0,-1.67929 1.3207,-3 3,-3 z" id="path453585" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none" />
              <path d="m 131,399.01367 a 1,1 0 0 0 -1,1 1,1 0 0 0 1,1 1,1 0 0 0 1,-1 1,1 0 0 0 -1,-1 z" id="path453573" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none" />
              <path d="m 131,393.01367 a 1,1 0 0 0 -1,1 v 3 a 1,1 0 0 0 1,1 1,1 0 0 0 1,-1 v -3 a 1,1 0 0 0 -1,-1 z" id="path453567" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none" />
              <path d="m 131,390.01367 c -2.63036,0 -4.9293,1.46542 -6.125,3.6211 -0.90021,-0.4054 -1.87895,-0.62123 -2.875,-0.6211 -3.85415,0 -7,3.14586 -7,7 0,3.85415 3.14585,7 7,7 a 1.000105,1.000105 0 0 0 0.002,0 c 2.57139,-0.007 4.90293,-1.42397 6.11524,-3.625 0.88031,0.40064 1.85579,0.625 2.88281,0.625 3.85414,0 7,-3.14585 7,-7 0,-3.85413 -3.14586,-7 -7,-7 z m 0,2 c 2.77327,0 5,2.22674 5,5 0,2.77327 -2.22673,5 -5,5 -0.98421,0 -1.89849,-0.28178 -2.66992,-0.76758 a 1.000005,1.000005 0 0 0 -0.2461,-0.16601 C 126.82049,400.17503 126,398.69579 126,397.01367 c 0,-0.5237 0.081,-1.02855 0.22852,-1.50195 a 1.000005,1.000005 0 0 0 0.10546,-0.30078 c 0.71945,-1.87506 2.52941,-3.19727 4.66602,-3.19727 z m -9,3 c 0.75319,-10e-5 1.49281,0.17045 2.16602,0.49414 -0.10719,0.48532 -0.16602,0.98922 -0.16602,1.50586 0,2.1085 0.94381,4.00364 2.42773,5.28906 -0.84495,1.64398 -2.53896,2.70503 -4.42773,2.71094 -2.77326,0 -5,-2.22673 -5,-5 0,-2.77326 2.22674,-5 5,-5 z" id="path453555" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;-inkscape-stroke:none" />
            </g>
          </g>
        </svg>
        <span class="sidebar-nav-text">Complaints</span>
      </a>

    </nav>
  </div>

  <!-- Sidebar footer -->
  <div class="sidebar-footer">
    <a href="logout.php" class="sidebar-logout">
      <svg class="sidebar-logout-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
      <span class="sidebar-logout-text">Log out</span>
    </a>
  </div>
</div>