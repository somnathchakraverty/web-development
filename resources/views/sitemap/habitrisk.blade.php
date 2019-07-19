<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        
    @foreach ($risk_list_details as $risk_list_detail) 
        <url>
            <loc>{{ route('risk-detail', [   'link_rewrite' => strtolower($risk_list_detail['alias'])]) }}</loc>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    
    @foreach ($habit_details as $habit_detail)
        <url>
            <loc>{{ route('habit-detail', [  'link_rewrite' => strtolower($habit_detail['alias'])]) }}</loc>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    
</urlset>