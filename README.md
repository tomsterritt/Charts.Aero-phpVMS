Charts.Aero-phpVMS
==================

phpVMS class for retrieving charts from Charts.aero

Usage
-----
Ensure you enter your mashape authorisation key in the static variable at the top of the class.

To retrieve by ICAO:  
`` $data = AeroCharts::GetByICAO('KRDM'); ``  

To retrieve by IATA:  
`` $data = AeroCharts::GetByIATA('RDM'); ``  

Both of the above will either return false (handle yourself), or an object, which can be used as follows (for example):  

`` $airportName = $data->airportName;	// Redmond Roberts Field  
$city = $data->city;					// Redmond  
$icao = $data->icao;					// KRDM  
$iata = $data->iata;					// RDM  
foreach($data->charts as $chart){  
	 $chartName 	= $chart->chart_name;		// "TAKEOFF MINIMUMS"  
	 $accurateOf 	= $chart->accurate_as_of;	// "1358507045"  
	 $fileURL 		= $chart->file_url;			// "http://a1d40817df887201f900-46f76acc0dd0843121c39db1cec939a0.r80.cf1.rackcdn.com/1-NW1TO.pdf"  
	 $fileSize 		= $chart->file_size;		// "226725"  
	 $fileThumbnail	= $chart->thumbnail_url;	// "http://a1d40817df887201f900-46f76acc0dd0843121c39db1cec939a0.r80.cf1.rackcdn.com/1-NW1TO.png"  
}``  

Also includes the Search function, but **does not** format response. See charts.aero documentation for response format.  
`` $data = AeroCharts::Search('Portland'); ``  

**NOTICE:** This has not and will not be tested, so I make no guarantee that this will work, however will maintain this repo, so feel free to create issues or pull requests for changes. 