(function () {
    if ( typeof window === 'undefined' || ! ( 'IntersectionObserver' in window ) ) {
        var elementsFallback = document.querySelectorAll('.fade-up');
        for ( var i = 0; i < elementsFallback.length; i += 1 ) {
            elementsFallback[i].classList.add('is-visible');
        }
        return;
    }

    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var observer = new IntersectionObserver(
        function (entries, entryObserver) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    entryObserver.unobserve(entry.target);
                }
            });
        },
        {
            rootMargin: '0px 0px -10% 0px',
            threshold: prefersReducedMotion ? 0 : 0.2
        }
    );

    document.querySelectorAll('.fade-up').forEach(function (element) {
        observer.observe(element);
    });
})();
