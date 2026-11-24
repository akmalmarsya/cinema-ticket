<style>
    .ct-site-header,
    .ct-site-header * {
        box-sizing: border-box;
    }

    .ct-site-header {
        position: sticky;
        top: 0;
        z-index: 1200;
        width: 100%;
        background: rgba(11, 16, 32, .96);
        border-bottom: 1px solid rgba(148, 163, 184, .16);
        box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    .ct-nav-shell {
        width: min(1280px, calc(100% - 64px));
        min-height: 78px;
        margin: 0 auto;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
    }

    .ct-brand {
        display: inline-flex;
        align-items: center;
        flex-shrink: 0;

        color: #ffffff;
        text-decoration: none;

        font-size: 23px;
        font-weight: 800;
        letter-spacing: .5px;
    }

    .ct-brand span {
        color: #f5b942;
    }

    .ct-nav-panel {
        display: flex;
        align-items: center;
        gap: 25px;
        margin-left: auto;
    }

    .ct-nav-links {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ct-nav-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;
        padding: 0 14px;

        border-radius: 8px;

        color: #cbd5e1;
        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        transition: background .2s ease, color .2s ease;
    }

    .ct-nav-link:hover {
        background: rgba(255, 255, 255, .06);
        color: #f5b942;
    }

    .ct-nav-link.is-active {
        color: #f5b942;
        background: rgba(245, 185, 66, .09);
    }

    .ct-nav-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-left: 5px;
    }

    .ct-nav-actions form {
        display: inline-flex;
        margin: 0;
    }

    .ct-nav-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 41px;
        padding: 0 16px;

        border: 1px solid transparent;
        border-radius: 8px;

        font-family: inherit;
        font-size: 12px;
        font-weight: 700;

        text-decoration: none;
        white-space: nowrap;

        cursor: pointer;
        transition: all .2s ease;
    }

    .ct-nav-account {
        background: rgba(245, 185, 66, .12);
        border-color: rgba(245, 185, 66, .3);
        color: #f5b942;
    }

    .ct-nav-account:hover {
        background: rgba(245, 185, 66, .2);
    }

    .ct-nav-login {
        background: transparent;
        border-color: #34435e;
        color: #e2e8f0;
    }

    .ct-nav-login:hover {
        border-color: #f5b942;
        color: #f5b942;
    }

    .ct-nav-register {
        background: #f5b942;
        color: #10172b;
    }

    .ct-nav-register:hover {
        background: #ffd477;
        transform: translateY(-1px);
    }

    .ct-nav-admin {
        background: transparent;
        border-color: #34435e;
        color: #cbd5e1;
    }

    .ct-nav-admin:hover {
        border-color: #f5b942;
        color: #f5b942;
    }

    .ct-nav-logout {
        background: transparent;
        border-color: #34435e;
        color: #cbd5e1;
    }

    .ct-nav-logout:hover {
        background: rgba(239, 68, 68, .1);
        border-color: #ef4444;
        color: #fca5a5;
    }

    /* MOBILE MENU BUTTON */

    .ct-nav-toggle {
        display: none;

        width: 43px;
        height: 43px;

        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 5px;

        background: transparent;
        border: 1px solid #34435e;
        border-radius: 8px;

        cursor: pointer;
    }

    .ct-nav-toggle span {
        display: block;
        width: 19px;
        height: 2px;

        background: #f5b942;
        border-radius: 5px;

        transition: all .2s ease;
    }

    .ct-nav-toggle[aria-expanded="true"] span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .ct-nav-toggle[aria-expanded="true"] span:nth-child(2) {
        opacity: 0;
    }

    .ct-nav-toggle[aria-expanded="true"] span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    .ct-nav-action:focus-visible,
    .ct-nav-link:focus-visible,
    .ct-brand:focus-visible,
    .ct-nav-toggle:focus-visible {
        outline: 2px solid #f5b942;
        outline-offset: 4px;
    }

    /* TABLET DAN MOBILE */

    @media (max-width: 900px) {

        .ct-nav-shell {
            width: calc(100% - 36px);
            min-height: 72px;
            flex-wrap: wrap;
            gap: 0;
        }

        .ct-brand {
            font-size: 21px;
        }

        .ct-nav-toggle {
            display: flex;
            margin-left: auto;
        }

        .ct-nav-panel {
            display: none;

            width: 100%;
            flex: 0 0 100%;

            flex-direction: column;
            align-items: stretch;
            gap: 10px;

            margin: 0;
            padding: 12px 0 17px;

            border-top: 1px solid rgba(148, 163, 184, .15);
        }

        .ct-nav-panel.is-open {
            display: flex;
        }

        .ct-nav-links {
            flex-direction: column;
            align-items: stretch;
            gap: 3px;
        }

        .ct-nav-link {
            justify-content: flex-start;
            width: 100%;
            padding: 0 14px;
        }

        .ct-nav-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 8px;

            margin: 5px 0 0;
            padding-top: 12px;

            border-top: 1px solid rgba(148, 163, 184, .15);
        }

        .ct-nav-actions form {
            display: flex;
            width: 100%;
        }

        .ct-nav-action {
            width: 100%;
            min-height: 43px;
            justify-content: center;
        }
    }

    @media (max-width: 430px) {

        .ct-nav-shell {
            width: calc(100% - 28px);
            min-height: 68px;
        }

        .ct-brand {
            font-size: 19px;
        }

    }

    /* CETAK E-TICKET */

    @media print {
        .ct-site-header {
            display: none !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .ct-site-header *,
        .ct-site-header *::before,
        .ct-site-header *::after {
            transition-duration: .01ms !important;
        }
    }
</style>