<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap', defaults: ['_format' => 'xml'])]
    public function index(MenuRepository $menuRepository): Response
    {
        try {
            $locales = ['es', 'en'];
            $urls = [];

            // Páginas home por locale
            foreach ($locales as $locale) {
                $urls[] = [
                    'loc' => $this->generateUrl('app_homepage_local', [
                        '_locale' => $locale,
                    ], 0),
                    'changefreq' => 'weekly',
                    'priority' => 1.0,
                ];
            }

            // Página de catálogo general por idioma
            foreach ($locales as $locale) {
                $urls[] = [
                    'loc' => $this->generateUrl('app_catalog', [
                        '_locale' => $locale,
                    ], 0),
                    'changefreq' => 'weekly',
                    'priority' => 0.9,
                ];
            }

            $menus = $menuRepository->getFilterMenuVsChilds();

            // Páginas hijas del menú
            foreach ($menus['withChilds'] as $parentMenu) {
                foreach ($parentMenu->getMenus() as $childMenu) {
                    $page = $childMenu->getPage();

                    if (!$page || !$page->isIsActive()) {
                        continue;
                    }

                    foreach ($locales as $locale) {
                        $translation = $page->translate($locale);
                        $slug = $translation?->getSlug();

                        if ($slug) {
                            $urls[] = [
                                'loc' => $this->generateUrl('app_page', [
                                    '_locale' => $locale,
                                    'slug' => $slug,
                                ], 0), // genera URL absoluta
                                'changefreq' => 'weekly',
                                'priority' => 0.8,
                            ];
                        }
                    }
                }
            }



            // Página de términos
            foreach ($locales as $locale) {
                $urls[] = [
                    'loc' => $this->generateUrl('app_terms', [
                        '_locale' => $locale,
                        'onlydata' => 'comp',
                    ], 0),
                    'changefreq' => 'monthly',
                    'priority' => 0.5,
                ];
            }

            $xmlContent = $this->renderView('seo/sitemap.xml.twig', [
                'urls' => $urls,
            ]);

            return new Response($xmlContent, 200, [
                'Content-Type' => 'application/xml; charset=UTF-8'
            ]);
        } catch (\Throwable $e) {
            return new Response(
                'Error generating sitemap: ' . $e->getMessage(),
                500,
                ['Content-Type' => 'text/plain']
            );
        }
    }
}
