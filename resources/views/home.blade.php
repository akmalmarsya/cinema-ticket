@php
    $featuredFilm = $films->first();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#0b1020">

    <meta
        name="description"
        content="CinemaTicket memudahkan kamu menemukan film, memilih jadwal, menentukan kursi, dan memesan tiket bioskop."
    >

    <title>CinemaTicket - Your Movie Experience</title>

    {{-- NAVBAR --}}
    @include('layouts.partials.public-navbar-styles')

    <style>

        /* =========================================
           GLOBAL
        ========================================= */

        :root {
            --bg: #0b1020;
            --surface: #151e33;
            --surface-light: #1b2943;
            --border: #293752;

            --gold: #f5b942;
            --gold-light: #ffd477;

            --white: #ffffff;
            --muted: #94a3b8;

            --container: 1280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: var(--bg);
            color: var(--white);
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        .container {
            width: min(var(--container), calc(100% - 80px));
            margin: auto;
        }

        .gold {
            color: var(--gold);
        }

        .section-label {
            color: var(--gold);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(25px, 3vw, 35px);
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -.7px;
        }

        .section-description {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
            margin-top: 12px;
        }


        /* BUTTON */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            min-height: 48px;
            padding: 0 22px;

            background: var(--gold);
            color: #10172b;

            border: 1px solid var(--gold);
            border-radius: 8px;

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                transform .25s ease,
                background .25s ease,
                box-shadow .25s ease;
        }

        .btn:hover {
            background: var(--gold-light);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 185, 66, .18);
        }

        .btn-outline {
            background: rgba(255,255,255,.04);
            border-color: rgba(255,255,255,.22);
            color: white;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,.1);
            border-color: var(--gold);
            color: var(--gold);
            box-shadow: none;
        }

        .btn-arrow {
            font-size: 17px;
            transition: transform .2s ease;
        }

        .btn:hover .btn-arrow {
            transform: translateX(4px);
        }


        /* =========================================
           HERO SECTION
        ========================================= */

        .hero {
            position: relative;
            isolation: isolate;

            min-height: 620px;

            display: flex;
            align-items: center;

            overflow: hidden;

            background:
                radial-gradient(
                    circle at 80% 40%,
                    #263b63,
                    #10172b 65%
                );

            scroll-margin-top: 90px;
        }

        .hero::before {
            content: "";

            position: absolute;
            inset: 0;
            z-index: -2;

            background-image:
                linear-gradient(
                    90deg,
                    rgba(11,16,32,.98) 0%,
                    rgba(11,16,32,.91) 38%,
                    rgba(11,16,32,.55) 72%,
                    rgba(11,16,32,.75) 100%
                ),
                var(
                    --hero-image,
                    radial-gradient(circle at center, #263b63, #10172b)
                );

            background-size: cover;
            background-position: center 35%;

            filter: saturate(.75);

            transform: scale(1.04);
        }

        .hero::after {
            content: "";

            position: absolute;
            inset: 0;
            z-index: -1;

            background:
                linear-gradient(
                    0deg,
                    var(--bg) 0%,
                    transparent 28%,
                    transparent 75%,
                    rgba(11,16,32,.35) 100%
                );
        }

        .hero-inner {
            width: min(var(--container), calc(100% - 80px));
            margin: auto;

            padding: 80px 0;

            display: grid;
            grid-template-columns: 1.1fr .9fr;
            align-items: center;

            gap: 70px;
        }

        .hero-content {
            max-width: 680px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            color: var(--gold);

            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;

            margin-bottom: 24px;
        }

        .hero-eyebrow::before {
            content: "";
            width: 27px;
            height: 2px;
            background: var(--gold);
        }

        .hero h1 {
            font-size: clamp(39px, 5.2vw, 67px);
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: -2px;

            max-width: 690px;
        }

        .hero h1 span {
            color: var(--gold);
        }

        .hero-description {
            color: #bdc8d9;

            font-size: 14px;
            line-height: 1.9;

            max-width: 520px;

            margin-top: 23px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;

            margin-top: 32px;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-top: 34px;

            color: #94a3b8;
            font-size: 11px;
        }

        .hero-note span {
            color: var(--gold);
        }


        /* =========================================
           FEATURED FILM CARD
        ========================================= */

        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;

            min-width: 0;
        }

        .featured-card {
            position: relative;

            display: flex;
            align-items: center;
            gap: 21px;

            width: 100%;
            max-width: 440px;

            padding: 17px;

            background: rgba(21,30,51,.78);
            border: 1px solid rgba(255,255,255,.15);

            border-radius: 15px;

            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);

            box-shadow: 0 25px 65px rgba(0,0,0,.35);

            transition: transform .3s ease, border-color .3s ease;
        }

        .featured-card:hover {
            transform: translateY(-6px);
            border-color: rgba(245,185,66,.6);
        }

        .featured-poster {
            width: 155px;
            min-width: 155px;

            aspect-ratio: 3 / 4;

            background: #10172b;

            border-radius: 9px;
            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .featured-poster img {
            width: 100%;
            height: 100%;

            object-fit: contain;
            object-position: center;

            display: block;
        }

        .featured-poster-placeholder {
            color: var(--gold);
            text-align: center;
            font-size: 12px;
            padding: 10px;
        }

        .featured-info {
            min-width: 0;
            flex: 1;
        }

        .featured-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 10px;

            background: rgba(245,185,66,.12);
            color: var(--gold);

            border-radius: 5px;

            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;

            margin-bottom: 16px;
        }

        .featured-info h2 {
            font-size: 19px;
            line-height: 1.4;
            margin-bottom: 10px;

            overflow-wrap: anywhere;
        }

        .featured-genre {
            color: var(--gold);
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 17px;
        }

        .featured-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .featured-meta span {
            background: rgba(255,255,255,.07);
            color: #cbd5e1;

            border-radius: 5px;
            padding: 6px 8px;

            font-size: 9px;
        }

        .featured-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: var(--gold);

            font-size: 11px;
            font-weight: 800;

            margin-top: 20px;
        }


        /* =========================================
           QUICK INFO STRIP
        ========================================= */

        .quick-strip {
            position: relative;
            z-index: 2;

            width: min(var(--container), calc(100% - 80px));
            margin: -1px auto 0;

            display: grid;
            grid-template-columns: repeat(3, 1fr);

            background: #111b31;
            border: 1px solid var(--border);
            border-radius: 12px;

            overflow: hidden;
        }

        .quick-item {
            display: flex;
            align-items: center;
            gap: 14px;

            padding: 22px 25px;

            border-right: 1px solid var(--border);
        }

        .quick-item:last-child {
            border-right: none;
        }

        .quick-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(245,185,66,.12);
            color: var(--gold);

            border-radius: 10px;

            font-size: 19px;
        }

        .quick-item strong {
            display: block;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .quick-item p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.5;
        }


        /* =========================================
           FILM SECTION
        ========================================= */

        .films {
            padding: 100px 0 95px;
            scroll-margin-top: 90px;
        }

        .films-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 34px;
        }

        .film-count {
            color: var(--gold);
            font-size: 12px;
            font-weight: 700;

            white-space: nowrap;

            padding: 10px 15px;

            background: rgba(245,185,66,.09);
            border: 1px solid rgba(245,185,66,.2);
            border-radius: 7px;
        }


        /* =========================================
           FILM GRID
        ========================================= */

        .film-list {
            display: grid;

            grid-template-columns: repeat(4, minmax(0, 1fr));

            gap: 22px;

            align-items: stretch;
        }

        .film-card {
            display: flex;
            flex-direction: column;

            min-width: 0;

            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;

            overflow: hidden;

            transition:
                transform .28s ease,
                border-color .28s ease,
                box-shadow .28s ease;
        }

        .film-card:hover {
            transform: translateY(-7px);

            border-color: var(--gold);

            box-shadow: 0 18px 35px rgba(0,0,0,.3);
        }


        /* POSTER */

        .poster {
            position: relative;

            width: 100%;
            aspect-ratio: 3 / 4;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            background:
                linear-gradient(
                    145deg,
                    #263b63,
                    #10172b
                );

            padding: 9px;
        }

        .poster img {
            display: block;

            width: 100%;
            height: 100%;

            object-fit: contain;
            object-position: center;

            transition: transform .35s ease;
        }

        .film-card:hover .poster img {
            transform: scale(1.035);
        }

        .poster-badge {
            position: absolute;
            top: 13px;
            left: 13px;
            z-index: 2;

            padding: 6px 9px;

            background: rgba(11,16,32,.88);
            border: 1px solid rgba(245,185,66,.35);

            border-radius: 5px;

            color: var(--gold);

            font-size: 8px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .poster-age {
            position: absolute;
            right: 13px;
            top: 13px;
            z-index: 2;

            padding: 6px 8px;

            background: rgba(11,16,32,.85);
            border-radius: 5px;

            color: white;
            font-size: 9px;
            font-weight: 700;
        }

        .poster-fallback {
            color: var(--gold);
            text-align: center;
            padding: 15px;
        }

        .poster-fallback .symbol {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .poster-fallback p {
            color: var(--muted);
            font-size: 9px;
            letter-spacing: 1px;
        }


        /* FILM INFO */

        .film-info {
            display: flex;
            flex-direction: column;
            flex: 1;

            padding: 17px;
        }

        .film-genre {
            color: var(--gold);

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .5px;

            margin-bottom: 9px;
        }

        .film-info h3 {
            color: white;

            font-size: 15px;
            line-height: 1.5;

            margin-bottom: 12px;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;

            min-height: 45px;
        }

        .film-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;

            margin-bottom: 13px;
        }

        .meta-item {
            background: #202c45;
            color: #cbd5e1;

            padding: 6px 8px;

            border-radius: 5px;

            font-size: 9px;
        }

        .film-description {
            color: var(--muted);

            font-size: 10px;
            line-height: 1.7;

            margin-bottom: 16px;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        .film-card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 8px;

            margin-top: auto;
            padding-top: 13px;

            border-top: 1px solid var(--border);
        }

        .film-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: #4ade80;

            font-size: 9px;
            font-weight: 700;
        }

        .film-status::before {
            content: "";

            width: 6px;
            height: 6px;

            background: #4ade80;
            border-radius: 50%;
        }

        .film-detail-link {
            color: var(--gold);

            font-size: 10px;
            font-weight: 800;

            white-space: nowrap;

            transition: color .2s;
        }

        .film-card:hover .film-detail-link {
            color: var(--gold-light);
        }


        /* EMPTY FILM */

        .empty-films {
            grid-column: 1 / -1;

            text-align: center;

            padding: 75px 20px;

            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 18px;
        }

        .empty-films h3 {
            font-size: 19px;
            margin-bottom: 10px;
        }

        .empty-films p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }


        /* =========================================
           BOOKING STEPS
        ========================================= */

        .steps-section {
            padding: 90px 0;

            background:
                linear-gradient(
                    115deg,
                    #111b31,
                    #10172b
                );

            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .steps-heading {
            text-align: center;
            max-width: 650px;

            margin: 0 auto 45px;
        }

        .steps-heading .section-description {
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);

            gap: 20px;
        }

        .step-card {
            position: relative;

            padding: 28px;

            background: #151e33;
            border: 1px solid var(--border);
            border-radius: 12px;

            transition: transform .25s, border-color .25s;
        }

        .step-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
        }

        .step-number {
            color: rgba(245,185,66,.35);

            font-size: 36px;
            font-weight: 900;

            line-height: 1;

            margin-bottom: 23px;
        }

        .step-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(245,185,66,.12);
            border-radius: 10px;

            color: var(--gold);
            font-size: 21px;

            margin-bottom: 19px;
        }

        .step-card h3 {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .step-card p {
            color: var(--muted);

            font-size: 11px;
            line-height: 1.8;
        }


        /* =========================================
           ADVANTAGES
        ========================================= */

        .advantages {
            padding: 95px 0;
        }

        .advantages-heading {
            margin-bottom: 35px;
        }

        .advantages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .advantage-card {
            padding: 25px;

            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .advantage-icon {
            font-size: 23px;
            color: var(--gold);
            margin-bottom: 17px;
        }

        .advantage-card h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .advantage-card p {
            color: var(--muted);

            font-size: 11px;
            line-height: 1.8;
        }


        /* =========================================
           ABOUT
        ========================================= */

        .about {
            padding: 85px 0;

            background:
                radial-gradient(
                    circle at 50% 0%,
                    rgba(245,185,66,.09),
                    transparent 65%
                ),
                #111b31;

            border-top: 1px solid var(--border);

            text-align: center;

            scroll-margin-top: 90px;
        }

        .about-inner {
            max-width: 750px;
            margin: auto;
        }

        .about h2 {
            font-size: clamp(25px, 3vw, 34px);
            line-height: 1.3;

            margin-bottom: 19px;
        }

        .about h2 span {
            color: var(--gold);
        }

        .about p {
            color: var(--muted);

            font-size: 13px;
            line-height: 2;
        }

        .about .btn {
            margin-top: 28px;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            background: #080d19;
            border-top: 1px solid var(--border);

            padding: 45px 0 22px;
        }

        .footer-main {
            display: flex;
            justify-content: space-between;
            gap: 30px;

            padding-bottom: 30px;
        }

        .footer-brand {
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .footer-brand span {
            color: var(--gold);
        }

        .footer-description {
            max-width: 350px;

            color: var(--muted);
            font-size: 11px;
            line-height: 1.9;
        }

        .footer-links {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #cbd5e1;
            font-size: 11px;
            transition: color .2s;
        }

        .footer-links a:hover {
            color: var(--gold);
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid var(--border);

            display: flex;
            justify-content: space-between;
            gap: 15px;

            color: #64748b;
            font-size: 10px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1100px) {

            .hero-inner {
                gap: 35px;
            }

            .hero h1 {
                font-size: 49px;
            }

            .film-list {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

        }


        @media (max-width: 800px) {

            .container,
            .hero-inner,
            .quick-strip {
                width: calc(100% - 44px);
            }

            .hero {
                min-height: auto;
            }

            .hero-inner {
                grid-template-columns: 1fr;
                gap: 45px;
                padding: 80px 0 65px;
            }

            .hero-content {
                max-width: 650px;
            }

            .hero h1 {
                font-size: 51px;
            }

            .hero-visual {
                justify-content: flex-start;
            }

            .featured-card {
                max-width: 480px;
            }

            .quick-item {
                padding: 17px 13px;
                gap: 10px;
            }

            .quick-icon {
                width: 35px;
                height: 35px;
                min-width: 35px;
                font-size: 16px;
            }

            .quick-item strong {
                font-size: 10px;
            }

            .quick-item p {
                font-size: 9px;
            }

            .film-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .steps-grid,
            .advantages-grid {
                grid-template-columns: 1fr 1fr;
            }

        }


        @media (max-width: 560px) {

            .container,
            .hero-inner,
            .quick-strip {
                width: calc(100% - 32px);
            }

            .hero-inner {
                padding: 65px 0 50px;
                gap: 38px;
            }

            .hero h1 {
                font-size: 39px;
                letter-spacing: -1.3px;
            }

            .hero-description {
                font-size: 12px;
            }

            .hero-eyebrow {
                font-size: 9px;
            }

            .hero-actions {
                gap: 9px;
            }

            .btn {
                min-height: 44px;
                padding: 0 15px;
                font-size: 10px;
            }

            .hero-note {
                font-size: 10px;
            }

            .featured-card {
                padding: 12px;
                gap: 13px;
            }

            .featured-poster {
                width: 115px;
                min-width: 115px;
            }

            .featured-tag {
                font-size: 8px;
                margin-bottom: 10px;
            }

            .featured-info h2 {
                font-size: 15px;
            }

            .featured-genre {
                font-size: 10px;
                margin-bottom: 10px;
            }

            .featured-meta span {
                font-size: 8px;
                padding: 5px 6px;
            }

            .featured-link {
                font-size: 9px;
                margin-top: 12px;
            }

            .quick-strip {
                grid-template-columns: 1fr;
            }

            .quick-item {
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding: 14px 18px;
            }

            .quick-item:last-child {
                border-bottom: none;
            }

            .films {
                padding: 70px 0;
            }

            .films-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .section-title {
                font-size: 26px;
            }

            .film-count {
                font-size: 10px;
            }

            .film-list {
                gap: 12px;
            }

            .poster {
                padding: 5px;
            }

            .poster-badge {
                top: 8px;
                left: 8px;
                padding: 5px 6px;
                font-size: 7px;
            }

            .poster-age {
                top: 8px;
                right: 8px;
                padding: 5px 6px;
                font-size: 8px;
            }

            .film-info {
                padding: 11px;
            }

            .film-info h3 {
                font-size: 12px;
                min-height: 36px;
                margin-bottom: 9px;
            }

            .film-genre {
                font-size: 9px;
            }

            .meta-item {
                font-size: 8px;
                padding: 5px 6px;
            }

            .film-description {
                font-size: 9px;
            }

            .film-status,
            .film-detail-link {
                font-size: 8px;
            }

            .steps-section,
            .advantages {
                padding: 70px 0;
            }

            .steps-grid,
            .advantages-grid {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .step-card,
            .advantage-card {
                padding: 21px;
            }

            .steps-heading {
                margin-bottom: 30px;
            }

            .about {
                padding: 70px 0;
            }

            .about h2 {
                font-size: 26px;
            }

            .about p {
                font-size: 11px;
            }

            .footer-main {
                flex-direction: column;
            }

            .footer-links {
                gap: 16px;
            }

            .footer-bottom {
                flex-direction: column;
            }

        }


        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }

        }

    </style>

</head>


<body>


{{-- =========================================
     NAVBAR
========================================= --}}

@include('layouts.partials.public-navbar')


{{-- =========================================
     HERO SECTION
========================================= --}}

<section
    class="hero"
    id="home"
    @if($featuredFilm && $featuredFilm->poster)
        style="--hero-image: url('{{ asset('storage/' . ltrim($featuredFilm->poster, '/')) }}')"
    @endif
>

    <div class="hero-inner">


        {{-- HERO CONTENT --}}

        <div class="hero-content">

            <div class="hero-eyebrow">
                YOUR MOVIE EXPERIENCE STARTS HERE
            </div>

            <h1>
                Cerita Hebat,
                <span>Pengalaman</span>
                Tak Terlupakan.
            </h1>

            <p class="hero-description">

                Temukan film favoritmu, pilih jadwal tayang,
                tentukan kursi terbaik, dan nikmati pengalaman
                menonton bioskop dengan lebih mudah bersama CinemaTicket.

            </p>


            <div class="hero-actions">

                <a href="#film" class="btn">

                    Jelajahi Film

                    <span class="btn-arrow">→</span>

                </a>

                @if($featuredFilm)

                    <a
                        href="{{ route('films.show', $featuredFilm) }}"
                        class="btn btn-outline"
                    >
                        Film Terbaru
                    </a>

                @endif

            </div>


            <div class="hero-note">

                <span>✦</span>

                Pemesanan tiket bioskop lebih praktis dan nyaman.

            </div>

        </div>


        {{-- FEATURED MOVIE --}}

        <div class="hero-visual">

            @if($featuredFilm)

                <a
                    href="{{ route('films.show', $featuredFilm) }}"
                    class="featured-card"
                    aria-label="Lihat detail film {{ $featuredFilm->judul }}"
                >

                    <div class="featured-poster">

                        @if($featuredFilm->poster)

                            <img
                                src="{{ asset('storage/' . ltrim($featuredFilm->poster, '/')) }}"
                                alt="Poster {{ $featuredFilm->judul }}"
                                fetchpriority="high"
                            >

                        @else

                            <div class="featured-poster-placeholder">
                                🎬
                                <p>POSTER BELUM TERSEDIA</p>
                            </div>

                        @endif

                    </div>


                    <div class="featured-info">

                        <div class="featured-tag">
                            ✦ FILM TERBARU
                        </div>

                        <h2>
                            {{ $featuredFilm->judul }}
                        </h2>

                        <div class="featured-genre">
                            {{ $featuredFilm->genre }}
                        </div>

                        <div class="featured-meta">

                            <span>
                                {{ $featuredFilm->durasi_menit }} Menit
                            </span>

                            <span>
                                {{ $featuredFilm->rating_usia }}
                            </span>

                        </div>

                        <div class="featured-link">

                            Lihat Detail Film

                            <span>→</span>

                        </div>

                    </div>

                </a>

            @else

                <div class="featured-card">

                    <div class="featured-info">

                        <div class="featured-tag">
                            CINEMATICKET
                        </div>

                        <h2>
                            Temukan Film Favoritmu
                        </h2>

                        <p class="section-description">
                            Film pilihanmu akan tampil di sini ketika
                            tersedia.
                        </p>

                    </div>

                </div>

            @endif

        </div>

    </div>

</section>



{{-- =========================================
     QUICK INFORMATION
========================================= --}}

<div class="quick-strip">


    <div class="quick-item">

        <div class="quick-icon">
            🎬
        </div>

        <div>

            <strong>
                Pilihan Film
            </strong>

            <p>
                Temukan film yang sedang tayang.
            </p>

        </div>

    </div>


    <div class="quick-item">

        <div class="quick-icon">
            ◷
        </div>

        <div>

            <strong>
                Jadwal Fleksibel
            </strong>

            <p>
                Pilih jadwal sesuai waktumu.
            </p>

        </div>

    </div>


    <div class="quick-item">

        <div class="quick-icon">
            ▣
        </div>

        <div>

            <strong>
                E-Ticket Praktis
            </strong>

            <p>
                Akses tiket melalui akunmu.
            </p>

        </div>

    </div>


</div>



{{-- =========================================
     FILM SECTION
========================================= --}}

<section class="films" id="film">

    <div class="container">


        <div class="films-heading">

            <div>

                <div class="section-label">
                    NOW SHOWING
                </div>

                <h2 class="section-title">
                    Film Sedang <span class="gold">Tayang.</span>
                </h2>

                <p class="section-description">

                    Pilih film favoritmu dan temukan pengalaman
                    menonton yang menyenangkan.

                </p>

            </div>


            <div class="film-count">

                {{ $totalFilms }} FILM TERSEDIA

            </div>

        </div>



        {{-- FILM GRID --}}

        <div class="film-list">


            @forelse($films as $film)


                <a
                    href="{{ route('films.show', $film) }}"
                    class="film-card"
                    aria-label="Lihat detail film {{ $film->judul }}"
                >


                    {{-- POSTER --}}

                    <div class="poster">

                        <span class="poster-badge">
                            NOW SHOWING
                        </span>

                        <span class="poster-age">
                            {{ $film->rating_usia }}
                        </span>


                        @if($film->poster)

                            <img
                                src="{{ asset('storage/' . ltrim($film->poster, '/')) }}"
                                alt="Poster {{ $film->judul }}"
                                loading="lazy"
                                decoding="async"
                                onerror="this.hidden=true; this.nextElementSibling.hidden=false;"
                            >

                            <div
                                class="poster-fallback"
                                hidden
                            >

                                <div class="symbol">🎬</div>

                                <p>POSTER TIDAK TERSEDIA</p>

                            </div>

                        @else

                            <div class="poster-fallback">

                                <div class="symbol">🎬</div>

                                <p>POSTER BELUM TERSEDIA</p>

                            </div>

                        @endif

                    </div>



                    {{-- FILM INFORMATION --}}

                    <div class="film-info">


                        <div class="film-genre">
                            {{ $film->genre }}
                        </div>


                        <h3>
                            {{ $film->judul }}
                        </h3>


                        <div class="film-meta">

                            <span class="meta-item">
                                {{ $film->durasi_menit }} Menit
                            </span>

                            <span class="meta-item">
                                {{ $film->rating_usia }}
                            </span>

                        </div>


                        <p class="film-description">

                            @if($film->sinopsis)

                                {{ \Illuminate\Support\Str::limit($film->sinopsis, 85) }}

                            @else

                                Informasi sinopsis belum tersedia.

                            @endif

                        </p>


                        <div class="film-card-bottom">

                            <span class="film-status">
                                Sedang Tayang
                            </span>

                            <span class="film-detail-link">
                                Detail →
                            </span>

                        </div>


                    </div>

                </a>


            @empty


                <div class="empty-films">

                    <div class="empty-icon">
                        🎬
                    </div>

                    <h3>
                        Belum Ada Film yang Tayang
                    </h3>

                    <p>
                        Saat ini belum tersedia film dengan status tayang.
                        Silakan kunjungi kembali nanti.
                    </p>

                </div>


            @endforelse


        </div>

    </div>

</section>



{{-- =========================================
     HOW TO BOOK
========================================= --}}

<section class="steps-section">

    <div class="container">


        <div class="steps-heading">

            <div class="section-label">
                SIMPLE BOOKING PROCESS
            </div>

            <h2 class="section-title">
                Pesan Tiket dalam <span class="gold">3 Langkah.</span>
            </h2>

            <p class="section-description">

                Nikmati proses pemesanan yang sederhana.
                Mulai dari memilih film hingga mendapatkan tiket digital.

            </p>

        </div>



        <div class="steps-grid">


            <div class="step-card">

                <div class="step-number">
                    01
                </div>

                <div class="step-icon">
                    🎬
                </div>

                <h3>
                    Pilih Film dan Jadwal
                </h3>

                <p>

                    Temukan film yang ingin kamu tonton,
                    kemudian pilih jadwal penayangan
                    yang paling sesuai.

                </p>

            </div>



            <div class="step-card">

                <div class="step-number">
                    02
                </div>

                <div class="step-icon">
                    ▦
                </div>

                <h3>
                    Tentukan Kursi
                </h3>

                <p>

                    Pilih tempat duduk favoritmu,
                    lengkapi informasi pemesanan,
                    dan lanjutkan ke proses pembayaran.

                </p>

            </div>



            <div class="step-card">

                <div class="step-number">
                    03
                </div>

                <div class="step-icon">
                    ▣
                </div>

                <h3>
                    Dapatkan E-Ticket
                </h3>

                <p>

                    Setelah pembayaran berhasil,
                    tiket digital dengan QR Code dapat
                    diakses kembali melalui akunmu.

                </p>

            </div>


        </div>

    </div>

</section>



{{-- =========================================
     ADVANTAGES
========================================= --}}

<section class="advantages">

    <div class="container">


        <div class="advantages-heading">

            <div class="section-label">
                WHY CINEMATICKET
            </div>

            <h2 class="section-title">
                Pengalaman Menonton
                <span class="gold">Lebih Praktis.</span>
            </h2>

            <p class="section-description">

                Semua kebutuhan pemesanan tiket bioskop
                tersedia dalam satu tempat.

            </p>

        </div>



        <div class="advantages-grid">


            <div class="advantage-card">

                <div class="advantage-icon">
                    ✦
                </div>

                <h3>
                    Pemesanan Mudah
                </h3>

                <p>

                    Temukan film, tentukan jadwal,
                    pilih kursi, dan lakukan pemesanan
                    melalui proses yang sederhana.

                </p>

            </div>



            <div class="advantage-card">

                <div class="advantage-icon">
                    ▣
                </div>

                <h3>
                    Tiket Digital
                </h3>

                <p>

                    Tiket digital dilengkapi QR Code
                    sehingga memudahkan proses
                    pemeriksaan tiket di bioskop.

                </p>

            </div>



            <div class="advantage-card">

                <div class="advantage-icon">
                    ◷
                </div>

                <h3>
                    Riwayat Pemesanan
                </h3>

                <p>

                    Lihat kembali transaksi dan
                    akses tiket yang sudah dibeli
                    melalui akun customer.

                </p>

            </div>


        </div>

    </div>

</section>



{{-- =========================================
     ABOUT SECTION
========================================= --}}

<section class="about" id="about">

    <div class="container">

        <div class="about-inner">

            <div class="section-label">
                ABOUT US
            </div>

            <h2>

                Welcome to

                <span>
                    CinemaTicket.
                </span>

            </h2>

            <p>

                CinemaTicket merupakan sistem informasi
                pemesanan tiket bioskop yang dirancang
                untuk memberikan kemudahan bagi pengguna
                dalam menemukan film, melihat informasi
                penayangan, memilih tempat duduk, dan
                melakukan pemesanan tiket secara praktis.

                Dengan dukungan tiket digital dan akun
                customer, pengalaman menonton menjadi
                lebih terorganisasi dan nyaman.

            </p>


            <a href="#film" class="btn">

                Temukan Film Favoritmu

                <span class="btn-arrow">→</span>

            </a>

        </div>

    </div>

</section>



{{-- =========================================
     FOOTER
========================================= --}}

<footer class="footer">

    <div class="container">


        <div class="footer-main">


            <div>

                <div class="footer-brand">

                    CINEMA<span>TICKET</span>

                </div>

                <p class="footer-description">

                    Your movie experience starts here.

                    Temukan film favoritmu dan nikmati
                    pengalaman menonton yang lebih praktis
                    bersama CinemaTicket.

                </p>

            </div>



            <div class="footer-links">

                <a href="{{ route('home') }}#home">
                    Home
                </a>

                <a href="{{ route('home') }}#film">
                    Film
                </a>

                <a href="{{ route('home') }}#about">
                    Tentang
                </a>

                @auth

                    @if(auth()->user()->role === 'customer')

                        <a href="{{ route('customer.dashboard') }}">
                            Akun Saya
                        </a>

                    @elseif(auth()->user()->role === 'admin')

                        <a href="{{ route('admin.dashboard') }}">
                            Dashboard Admin
                        </a>

                    @endif

                @else

                    <a href="{{ route('customer.login') }}">
                        Login
                    </a>

                    <a href="{{ route('customer.register') }}">
                        Daftar
                    </a>

                @endauth

            </div>


        </div>



        <div class="footer-bottom">

            <span>
                © {{ date('Y') }} CinemaTicket. All Rights Reserved.
            </span>

            <span>
                Made for Movie Lovers.
            </span>

        </div>


    </div>

</footer>



</body>
</html>