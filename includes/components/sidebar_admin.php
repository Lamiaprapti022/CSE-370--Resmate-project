<!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
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
      <!-- All Posts -->
      <a href="home_admin.php" class="sidebar-nav-item sidebar-nav-item-current">
        <svg class="sidebar-nav-icon" viewBox="0 -4 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">

          <title>bullet-list</title>
          <desc>Created with Sketch Beta.</desc>
          <defs>

          </defs>
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-570.000000, -209.000000)" fill="#000000">
              <path d="M597,226 L579,226 C578.447,226 578,226.448 578,227 C578,227.553 578.447,228 579,228 L597,228 C597.553,228 598,227.553 598,227 C598,226.448 597.553,226 597,226 L597,226 Z M572,209 C570.896,209 570,209.896 570,211 C570,212.104 570.896,213 572,213 C573.104,213 574,212.104 574,211 C574,209.896 573.104,209 572,209 L572,209 Z M579,212 L597,212 C597.553,212 598,211.553 598,211 C598,210.447 597.553,210 597,210 L579,210 C578.447,210 578,210.447 578,211 C578,211.553 578.447,212 579,212 L579,212 Z M597,218 L579,218 C578.447,218 578,218.448 578,219 C578,219.553 578.447,220 579,220 L597,220 C597.553,220 598,219.553 598,219 C598,218.448 597.553,218 597,218 L597,218 Z M572,217 C570.896,217 570,217.896 570,219 C570,220.104 570.896,221 572,221 C573.104,221 574,220.104 574,219 C574,217.896 573.104,217 572,217 L572,217 Z M572,225 C570.896,225 570,225.896 570,227 C570,228.104 570.896,229 572,229 C573.104,229 574,228.104 574,227 C574,225.896 573.104,225 572,225 L572,225 Z" id="bullet-list" sketch:type="MSShapeGroup">

              </path>
            </g>
          </g>
        </svg>
        <span class="sidebar-nav-text">All Posts</span>
      </a>

      <!-- Approvals -->
      <a href="admin_all_post.php" class="sidebar-nav-item">
        <svg fill="#000000" class="sidebar-nav-icon" viewBox="0 0 270.92 270.92" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

          <defs>

            <style type="text/css">
              <![CDATA[
              .fil0 {
                fill: black;
                fill-rule: nonzero
              }
              ]]>
            </style>

          </defs>

          <g id="Layer_x0020_1">

            <path class="fil0" d="M218.45 48.17l-166.76 0c-4.38,0 -7.93,3.55 -7.93,7.93 0,4.38 3.55,7.93 7.93,7.93l166.76 0c11.12,0 20.18,9.05 20.18,20.19l0 0.75 -186.94 0c-4.38,0 -7.93,3.55 -7.93,7.93 0,4.4 3.55,7.94 7.93,7.94l186.94 0 0 85.87c0,11.12 -9.06,20.17 -20.18,20.17l-165.97 0c-11.12,0 -20.18,-9.05 -20.18,-20.17l0 -103.27c0,-4.39 -3.56,-7.95 -7.95,-7.95 -4.37,0 -7.92,3.56 -7.92,7.95l0 103.27c0,19.87 16.17,36.03 36.05,36.03l165.97 0c19.88,0 36.05,-16.16 36.05,-36.03l0 -102.49c0,-19.89 -16.17,-36.05 -36.05,-36.05zm-103.96 132.85c1.54,0 3.09,-0.45 4.45,-1.36l69.65 -47.31c3.63,-2.46 4.57,-7.41 2.11,-11.03 -2.45,-3.62 -7.39,-4.57 -11.02,-2.09l-63.9 43.38 -23.07 -25.88c-2.92,-3.28 -7.94,-3.58 -11.2,-0.64 -3.27,2.91 -3.56,7.93 -0.63,11.2l27.68 31.07c1.56,1.75 3.73,2.66 5.93,2.66z" />

          </g>

        </svg>
        <span class="sidebar-nav-text">Approvals</span>
      </a>

      <!-- All Users -->
      <a href="admin_all_user.php" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="9" cy="6" r="4" stroke="#1C274C" stroke-width="1.5" />
          <path d="M15 9C16.6569 9 18 7.65685 18 6C18 4.34315 16.6569 3 15 3" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
          <ellipse cx="9" cy="17" rx="7" ry="4" stroke="#1C274C" stroke-width="1.5" />
          <path d="M18 14C19.7542 14.3847 21 15.3589 21 16.5C21 17.5293 19.9863 18.4229 18.5 18.8704" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
        </svg>
        <span class="sidebar-nav-text">All Users</span>
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

      <!-- Banned Users-->
      <a href="#" class="sidebar-nav-item">
        <svg class="sidebar-nav-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M24 5C29.1176 5 33.7626 7.02325 37.1788 10.3135C37.2763 10.381 37.3688 10.458 37.4554 10.5446C37.542 10.6312 37.619 10.7237 37.6864 10.8209C40.9767 14.2374 43 18.8824 43 24C43 34.4934 34.4934 43 24 43C13.5066 43 5 34.4934 5 24C5 13.5066 13.5066 5 24 5ZM35.9269 14.9021L14.9021 35.9269C17.4256 37.8548 20.5791 39 24 39C32.2843 39 39 32.2843 39 24C39 20.7159 37.9446 17.6783 36.1545 15.2079L35.9269 14.9021ZM24 9C15.7157 9 9 15.7157 9 24C9 27.4209 10.1452 30.5744 12.0731 33.0979L33.0979 12.0731C30.5744 10.1452 27.4209 9 24 9Z" fill="#212121" />
        </svg>
        <span class="sidebar-nav-text">Banned Users</span>
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