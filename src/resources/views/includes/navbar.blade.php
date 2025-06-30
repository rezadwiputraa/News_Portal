<!-- Nav -->
<div class="sticky top-0 z-50 py-5 px-4 lg:px-14 bg-white shadow-sm">
    <div class="nav-container">

      <!-- Search (Kiri) -->
      <div class="search-container">
        <div class="relative">
            <form action="{{ route('news.search') }}" method="GET">
                <input
                    type="text"
                    placeholder="Cari berita..."
                    id="searchInput"
                    class="search-input"

                />
                <!-- Icon Search -->
                <span class="search-icon">
                    <img src="{{ asset('assets/img/search.png') }}" alt="search" class="icon" />
                </span>
            </form>
        </div>
      </div>

      <!-- Logo (Tengah) -->
      <div class="logo-center">
        <a href="{{ route('landing') }}">
          <div class="logo-container">
            <img src="{{ asset('assets/img/logos/logo.png') }}" alt="Logo" class="logo20" />
          </div>
        </a>
      </div>

      <!-- Menu (Kanan) -->
      <div class="menu-container">
        <!-- Tombol Hamburger (Mobile) -->
        <button class="menu-toggle" id="menu-toggle">☰</button>

        <!-- Menu Navigasi untuk Desktop -->
        <div class="menu-links">
            <ul class="menu-list">
                <li>
                    <a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>
                @foreach (\App\Models\NewsCategory::all() as $category)
                    <li>
                        <a href="{{ route('news.category', $category->slug) }}"
                           class="{{ request()->is($category->slug) ? 'active' : '' }}">
                            {{ $category->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Menu Dropdown untuk Mobile -->
        <div id="dropdown-menu" class="dropdown-menu">
            <a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a>
            @foreach (\App\Models\NewsCategory::all() as $category)
                <a href="{{ route('news.category', $category->slug) }}"
                   class="{{ request()->is($category->slug) ? 'active' : '' }}">
                    {{ $category->title }}
                </a>
            @endforeach
        </div>
    </div>
    </div>
</div>



<style>
.nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.search-container {
  flex: 1;
  display: flex;
  justify-content: flex-start;
}

.logo-center {
  flex: 1;
  display: flex;
  justify-content: center;
}

.menu-container {
  flex: 1;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.search-input {
  border: 1px solid #cbd5e1;
  border-radius: 9999px;
  padding: 8px 16px 8px 32px;
  width: 100%;
  max-width: 250px;
  font-size: 14px;
  font-family: sans-serif;
  outline: none;
  transition: all 0.3s ease;
}

.search-input:focus {
  border-color: #800080;
  box-shadow: 0 0 0 2px #800080;
}

.search-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
}

.icon {
  width: 16px;
}

.menu-toggle {
  display: none;
  background: none;
  border: none;
  font-size: 24px;
  color: #800080;
}

.menu-links {
  display: flex;
}

.menu-list {
  list-style: none;
  display: flex;
  gap: 16px;
  padding: 0;
  margin: 0;
}

.menu-list li a {
  text-decoration: none;
  color: #1e293b;
  font-weight: 500;
  transition: color 0.3s ease;
}

.menu-list li a:hover {
  color: #800080;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo20 {
  width: 32px;
}

@media (min-width: 1024px) {
  .logo20 {
    width: 40px;
  }

  .menu-toggle {
    display: none;
  }
}

@media (max-width: 1023px) {
  .menu-links {
    display: none;
  }

  .menu-toggle {
    display: block;
  }
}
/* Sembunyikan dropdown secara default */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 100%;
    background: white;
    z-index: 1000;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);

    /* Tambahan untuk center */
    display: flex;
    flex-direction: column;
    align-items: center;     /* Horizontal center */
    justify-content: center; /* Vertical center */
    gap: 20px;               /* Jarak antar item */
    text-align: center;
}
.dropdown-menu {
  display: none;
  /* ... seperti di atas */
}

/* Tampilkan saat aktif */
.dropdown-menu.show {
    display: flex;
}

.menu-toggle {
    font-size: 28px;
    border: none;
    background: none;
    cursor: pointer;
    display: none;
}

/* Navigasi Desktop */
.menu-links {
    display: flex;
}

.menu-list {
    display: flex;
    gap: 20px;
    list-style: none;
    padding: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .menu-links {
        display: none;
    }

    .menu-toggle {
        display: block;
    }
}

/* Active Link */
a.active {
    color: #800080;
    font-weight: bold;
}

</style>

<script>
    const toggle = document.getElementById('menu-toggle');
    const dropdown = document.getElementById('dropdown-menu');

    document.getElementById('menu-toggle').addEventListener('click', () => {
    document.getElementById('dropdown-menu').classList.toggle('show');
    });
</script>
