<guess-layout>
    <div>
        Hello
    </div>

    <script>
        import {regions, provinces, cities, barangays} from 'select-philippines-address';

        regions().then((region) => console.log(region));
        provinces('01').then((province) => console.log(province));
        cities('0128').then((city) => console.log(city)); 
        barangays('052011').then((barangays) => console.log(barangays));
    </script>
</guess-layout>
            
