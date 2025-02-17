<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $url = 'https://api.cloudflare.com/client/v4/graphql';
        $zoneId = 'a61d04cf38e8c9a131e85fd1e57ea769'; // Replace with your actual Cloudflare Zone ID
        $apiKey = 'rHH7kbZw_k9-cNDOPqU4HXUcN2O3PrAyF4ICCQqA'; // Replace with your actual API key

        $today = Carbon::now()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        
        $query = "
        {
            viewer {
                zones(filter: {zoneTag: \"$zoneId\"}) {
                    firewallEvents: firewallEventsAdaptive(
                        filter: {datetime_gt: \"$yesterday T00:00:00Z\", datetime_lt: \"$today T00:00:00Z\"},
                        limit: 10,
                        orderBy: [datetime_DESC]
                    ) {
                        action
                        datetime
                        host: clientRequestHTTPHost
                    }
                    
                    deviceTypes: httpRequestsAdaptiveGroups(
                        filter: {date: \"$today\"},
                        limit: 10,
                        orderBy: [count_DESC]
                    ) {
                        count
                        dimensions { device: clientDeviceType }
                    }
                    
                    httpRequests: httpRequestsAdaptiveGroups(
                        filter: {datetime_gt: \"$yesterday T00:00:00Z\", datetime_lt: \"$today T00:00:00Z\"},
                        limit: 10
                    ) {
                        count
                        sum { visits edgeResponseBytes cachedRequests cachedBytes }
                    }
                }
            }
        }";

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
        ])->post($url, ['query' => $query]);

        dd( $response->json());

        if ($response->successful()) {
            $data = $response->json();
            
            $zoneData = $data['data']['viewer']['zones'][0] ?? [];
            
            $httpRequests = $zoneData['httpRequests'][0]['count'] ?? 0;
            $cachedRequests = $zoneData['httpRequests'][0]['sum']['cachedRequests'] ?? 0;
            $totalDataServed = $zoneData['httpRequests'][0]['sum']['edgeResponseBytes'] ?? 0;
            $dataCached = $zoneData['httpRequests'][0]['sum']['cachedBytes'] ?? 0;
            $uniqueVisitors = $zoneData['httpRequests'][0]['sum']['visits'] ?? 0;
            
            $percentCached = ($httpRequests > 0) ? ($cachedRequests / $httpRequests) * 100 : 0;

            $chartData = [
                'Total Requests' => $httpRequests,
                'Cached Requests' => $cachedRequests,
                'Total Data Served (MB)' => round($totalDataServed / (1024 * 1024), 2),
                'Data Cached (MB)' => round($dataCached / (1024 * 1024), 2),
                'Unique Visitors' => $uniqueVisitors,
            ];

            $chart = Chartjs::build()
                ->name("CloudflareAnalyticsChart")
                ->type("bar")
                ->size(["width" => '100%', "height" => 200])
                ->labels(['Today'])
                ->datasets(collect($chartData)->map(fn($value, $key) => [
                    'label' => $key,
                    'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                    'borderColor' => 'rgba(38, 185, 154, 0.7)',
                    'data' => [$value],
                ])->toArray())
                ->options([
                    'scales' => ['x' => ['type' => 'category']],
                    'plugins' => ['title' => ['display' => true, 'text' => 'Cloudflare Analytics (Last 24 Hours)']]
                ]);

            return view('dashboard', compact('chart', 'percentCached', 'httpRequests', 'cachedRequests', 'totalDataServed', 'dataCached', 'uniqueVisitors'));
        }

        return response()->json(['error' => 'Failed to fetch data from Cloudflare'], 500);
    }
}
