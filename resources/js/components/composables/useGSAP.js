/**
 * Composable for loading GSAP dynamically
 */

export function useGSAP() {
  /**
   * Dynamically loads GSAP from CDN or uses the already loaded instance
   * @returns {Promise<Object>} GSAP instance
   */
  const loadGSAP = () => {
    return new Promise((resolve) => {
      // If GSAP is already loaded globally, use it
      if (window.gsap) {
        console.log('GSAP already loaded, using global instance');
        resolve(window.gsap);
        return;
      }
      
      // CDN sources for GSAP
      const cdnSources = [
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js',
        'https://unpkg.com/gsap@3.12.2/dist/gsap.min.js'
      ];
      
      // Try loading GSAP from each source until successful
      const tryLoadFromNextSource = (sourceIndex) => {
        // If we've tried all sources, resolve with null
        if (sourceIndex >= cdnSources.length) {
          console.error('Failed to load GSAP from all sources');
          resolve(null);
          return;
        }
        
        const script = document.createElement('script');
        script.src = cdnSources[sourceIndex];
        
        script.onload = () => {
          console.log(`GSAP successfully loaded from ${cdnSources[sourceIndex]}`);
          resolve(window.gsap);
        };
        
        script.onerror = () => {
          console.warn(`Failed to load GSAP from ${cdnSources[sourceIndex]}, trying next source`);
          // Try next source
          tryLoadFromNextSource(sourceIndex + 1);
        };
        
        document.head.appendChild(script);
      };
      
      // Start with the first source
      tryLoadFromNextSource(0);
    });
  };

  return {
    loadGSAP
  };
} 