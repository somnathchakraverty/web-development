<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($packages as $city_name   =>  $package_detail)
        @foreach($package_detail as $package)
            <url>
                <loc>{{ route('product.'.$ptype.'-detail', [  
                                'city'          =>  strtolower($city_name), 
                                'link_rewrite'  =>  strtolower($package->link_rewrite)
                            ]) }}</loc>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach
    @endforeach

    @if($ptype == 'package')
        @foreach($city_list as $ct)
            <url>
                <loc>
                    {{route('product.city-package-list', [   
                                'city'  => str_replace(' ', '_', strtolower($ct['name']))
                            ]
                    )}}
                </loc>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach
    @endif
    
</urlset>