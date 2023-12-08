<table class="table table-bordered">
    <tr >
        <th >Id</th>
        <td>{{ $data->city_id}}</td>
        <th>City</th>
        <td>{{ $data->city}}</td>
    </tr>
    
    <tr >
        <th >City Ascii</th>
        <td>{{ $data->city_ascii}}</td>
        <th>  State Id</th>
        <td>{{ $data->state_id}}</td>
    </tr>
 
    <tr >
        <th >State Name</th>
        <td>{{ $data->state_name}}</td>
        <th > County Fips</th>
        <td>{{ $data->county_fips}}</td>
    </tr>
    <tr >
        <th >County name</th>
        <td>{{ $data->county_name}}</td>
        <th >Lat</th>
        <td>{{ $data->lat}}</td>
    </tr>
    <tr >
        
        <th >Lng</th>
        <td>{{ $data->lng}}</td>
        <th>Population</th>
        <td>{{ $data->population}}</td>
    </tr>
    <tr >
   
        <th >Density</th>
        <td>{{ $data->density}}</td>
        <th >Source</th>
        <td>{{ $data->source}}</td>
    </tr>
    <tr >
       
        <th >Military</th>
        <th>{{ $data->military}}</td>
        <td >Incorporated</th>
        <td>{{ $data->incorporated}}</td>
    </tr>
    <tr >
     
        <th >Timezone</th>
        <td>{{ $data->timezone}}</td>
        <th >Ranking</th>
        <td>{{ $data->ranking}}</td>
    </tr>
    <tr>
        <th >Zips</th>
        <td>{{ $data->zips}}</td>
    </tr>
 
    
</table>