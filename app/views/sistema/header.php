<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

        html,
        body {
        overflow-x: hidden; /* Prevent scroll on narrow devices */
        }

        body {
        padding-top: 56px;
        }

        @media (max-width: 991.98px) {
        .offcanvas-collapse {
            position: fixed;
            top: 56px; /* Height of navbar */
            bottom: 0;
            left: 100%;
            width: 100%;
            padding-right: 1rem;
            padding-left: 1rem;
            overflow-y: auto;
            visibility: hidden;
            background-color: #343a40;
            transition: transform .3s ease-in-out, visibility .3s ease-in-out;
        }
        .offcanvas-collapse.open {
            visibility: visible;
            transform: translateX(-100%);
        }
        }

        .nav-scroller .nav {
        color: rgba(255, 255, 255, .75);
        }

        .nav-scroller .nav-link {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: .875rem;
        color: #6c757d;
        }

        .nav-scroller .nav-link:hover {
        color: #007bff;
        }

        .nav-scroller .active {
        font-weight: 500;
        color: #343a40;
        }

        .bg-purple {
        background-color: #6f42c1;
        }

        .no {
            display: block
        }
    </style>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark container" aria-label="Main navigation">
        <div class="container-fluid">
            <a href="<?=URL?>/home" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">Zamp Pet</span>
            </a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top: 12px;">Atendimentos</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=URL?>/clientes">Clientes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top: 12px;">Recursos Humanos</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=URL?>/funcionarios">Funcionarios</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex" hidden>
                    <li class="nav-item dropdown no" style="color: white;">
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">Configurações</a>
                        <ul class="dropdown-menu">	
                            <li><a class="dropdown-item" href="<?=URL?>/auth/logout">Sair</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
            Helper::mostrarNotificacao();
        ?>
    </div>
    <script src="<?=URL?>/public/js/navbar.js"></script>