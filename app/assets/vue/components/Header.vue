<script setup>

import LogoIcon from "./icons/LogoIcon.vue";
</script>

<template>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <LogoIcon></LogoIcon>
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
<!--                    <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>-->
                </ul>
                <form class="mb-3 mb-lg-0 me-lg-3" role="search" style="flex-grow: 0.4">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
                <div class="d-flex">
                    <ul class="nav flex-nowrap mb-3 mb-lg-0 me-lg-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <span id="currentLangFlag">🇺🇸 English</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#" data-lang="en" data-flag="🇺🇸" data-text="English">
                                        🇺🇸 English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" data-lang="ru" data-flag="🇷🇺" data-text="Русский">
                                        🇷🇺 Русский
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item py-2 py-lg-1">
                            <div class="vr h-100 mx-2"></div>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="d-none">
                                <i class="bi bi-moon-stars-fill"></i>
                                <i class="bi bi-sun-fill"></i>
                            </div>
                            <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center show" id="bd-theme" type="button" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
                                <i class="bi bi-sun-fill me-2"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text" data-bs-popper="static">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                                        <i class="bi bi-sun-fill me-2"></i>
                                        Light
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                        <i class="bi bi-moon-stars-fill me-2"></i>
                                        Dark
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item py-2 py-lg-1">
                            <div class="vr h-100 mx-2"></div>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="#" alt="" width="32" height="32" class="rounded-circle" style="vertical-align: bottom">
                        </a>
                        <ul class="dropdown-menu text-small" style="">
                            <li class="dropdown-header">
                                <h6>Kevin Anderson</h6>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-plus-square me-2"></i>New inventory</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-grid me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

</template>

<style scoped>

</style>
