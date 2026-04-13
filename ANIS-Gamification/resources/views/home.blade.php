<header class="fixed top-0 w-full flex justify-between items-center px-6 py-4 bg-white/80 backdrop-blur z-50">
  <div class="flex items-center gap-2">
    <span class="text-2xl font-bold text-purple-600">ANIS</span>
  </div>

  <nav class="hidden md:flex gap-6">
    <a href="#" class="text-purple-600 font-bold">Accueil</a>
    <a href="#about">À propos</a>
    <a href="#services">Services</a>
    <a href="#team">Équipe</a>
  </nav>

  <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded-full">
    Commencer
  </a>
</header>
<section class="pt-28 px-6 flex flex-col lg:flex-row items-center justify-between">
  <div class="max-w-xl">
    <h1 class="text-5xl font-bold mb-6">
      ANIS : Apprendre à gérer les addictions
    </h1>

    <p class="text-gray-600 mb-6">
      Une plateforme interactive pour comprendre et gérer les addictions de manière ludique.
    </p>

    <div class="flex gap-4">
      <button class="bg-purple-600 text-white px-6 py-3 rounded-lg">
        Débuter
      </button>
      <button class="border border-purple-600 text-purple-600 px-6 py-3 rounded-lg">
        Ressources
      </button>
    </div>
  </div>

  <img src="{{ asset('image/img1.jpg') }}" class="w-[400px] rounded-xl shadow-lg" />
</section>
<section id="about" class="px-6 py-20 bg-gray-50">
  <h2 class="text-3xl font-bold mb-6">À propos</h2>

  <p class="text-gray-600 max-w-2xl">
    ANIS est une plateforme qui aide les utilisateurs à comprendre leurs comportements et à développer des habitudes saines.
  </p>
</section>

