<x-app-layout>
<div class="mx-auto h-screen shadow-xl sm:rounded-lg" style="background:#02194fe0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
    <div class="py-5 data_filter_wraper header_" style="color: #fff;">
        <div class="flex justify-start gap-4 items-center mb-5">
            <div class="search_wraper flex space-x-4 items-center">
                <select class="bg-transparent shadow-md"  title="Print Rows" style="border-radius: 8px; border: 1px solid #02192f00;">
                    <option value="page_id">Page ID</option>
                    <option value="page_url">Page URL</option>
                    <option value="Page_name">Page Name</option>
                    <option value="page_body">Page Body</option>
                </select>
                <input type="text" placeholder="Enter Keyword...." title="keyword"class="bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;" />
            </div>
            <div class="print_rows_wraper flex space-x-4">
                <select placeholder="Print Rows" title="Print Rows"class="bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;">
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="print_rows_wraper flex space-x-4">
                <select placeholder="PrintRows" class="bg-transparent shadow-md"  title="Print Rows" style="border-radius: 8px; border: 1px solid #02192f00;">
                    <option value="25">Public</option>
                    <option value="50">Private</option>
                    <option value="100">Delet</option>
                </select>
            </div>
        </div>
    </div>
    <div class="pt-4 pb-5">
        <table class="table w-full table-auto text-white border-collapse">
            <thead>
                <tr>
                    <th class="text-left align-middle p-4 border-b"> 
                        <input type="checkbox" style="transform: scale(1.2);" />
                    </th>
                    <th class="text-left p-4 border-b">ID</th>
                    <th class="text-left p-4 border-b">Page Name</th>
                    <th class="text-left p-4 border-b">Page URL</th>
                    <th class="text-left p-4 border-b">Page Lang</th>
                    <th class="text-left p-4 border-b">State</th>
                    <th class="text-left p-4 border-b"></th>
                </tr>
            </thead>
            <tbody>
                @if($pages->isEmpty()) <!-- Check if there are no pages -->
                    <tr>
                        <td colspan="7" class="text-center p-4">
                            <span class="text-xl text-gray-500">No data found</span>
                        </td>
                    </tr>
                @else

                    <!-- Loop through pages and display them -->
                    @foreach($pages as $page)
                        <tr>
                            <td class="text-left align-middle p-4 border-b">
                                <input type="checkbox" style="transform: scale(1.2);" />
                            </td>
                            <td class="p-4 border-b">{{ $page->page_id }}</td>
                            <td class="p-4 border-b">{{ $page->page_slug }}</td>
                            <td class="p-4 border-b">{{ $page->page_url }}</td>
                            <td class="p-4 border-b">
                                @if($page->locale == "en")
                                <img src="https://th.bing.com/th/id/OIP.e_bbO_MwobphE7AiIzUzyQHaEA?rs=1&pid=ImgDetMain" width="42" height="35" />
                                @else
                                <img src="https://th.bing.com/th/id/R.c1bdf4971c7213768cefe157662100f8?rik=a8bEmzkPm3YN9w&riu=http%3a%2f%2fimages6.fanpop.com%2fimage%2fphotos%2f35300000%2fKhmer-Flag-countries-35346940-2560-1707.png&ehk=qhETiSjoRr%2broswCg5rBmNSsNTRGgre9W%2ftT7BqR2Ao%3d&risl=&pid=ImgRaw&r=0" width="42" height="35" />
                                @endif
                            </td>
                            <td class="p-4 border-b">
                                <span class="px-3 py-1 rounded-sm {{ $page->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $page->status == 1 ? "Public" : "Private" }}
                                </span>

                            </td>
                            <td class="p-4 border-b text-center">
                                <a href="#" class="px-3 py-1 bg-green-400 rounded-sm">View</a>
                                <a href="{{ 
                                    route(
                                    'page_manager.modify', 
                                    $page->page_slug).
                                    "?page_id=". $page->page_id 
                                    }}" 
                                    class="px-3 py-1 bg-blue-400 rounded-sm">
                                    Edit
                                </a>
                                <a href="#" class="px-3 py-1 bg-red-400 rounded-sm">DEL</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

</x-app-layout>