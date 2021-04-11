@extends('../manager.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Хичээлийн хуваарь</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            
        </div>
    </div>
     <!-- BEGIN: Hoverable Table -->
     <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Hoverable Table</h2>
        </div>
        <div class="p-5" id="hoverable-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table border-yellow-500" style="border:1px solid red !important">
                        <thead>
                            <tr>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Цаг / Өдөр</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Даваа</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Мягмар</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Лхагва</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Пүрэв</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Баасан</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $date = explode(":", config('settings.huvaari_ehleh'));


                                // print_r($date );
                                $tsag = $date[0];
                                $minu = $date[1]; 

                            ?>
                            @for($i = 1; $i < config('settings.huvaari_ehleh'); $i++)
                                <?php
                                    if($i < 4){
                                        $ihzav = 20;
                                    }else{
                                        $ihzav = 0;
                                    }

                                    $start = date("H:i", mktime($tsag, $minu + (5 * ($i - 1)) + (80 * ($i - 1)) + $ihzav, 0, 0, 0, 2000));
                                    $end = date("H:i", mktime($tsag, $minu + (5 * ($i - 1)) + (80 * $i) + $ihzav, 0, 0, 0, 2000));
                                ?>
                            <tr class="hover:bg-blue-900">
                                <td class="border border-b-2 dark:border-dark-5">
                                    {{ $i }} - р цаг
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ $start }} - {{ $end }}</div>
                                </td>
                                <td class="border border-b-2 dark:border-dark-5 cal-1-{{$i}}"></td>
                                <td class="border border-b-2 dark:border-dark-5 cal-2-{{$i}}"></td>
                                <td class="border border-b-2 dark:border-dark-5 cal-3-{{$i}}"></td>
                                <td class="border border-b-2 dark:border-dark-5 cal-4-{{$i}}"></td>
                                <td class="border border-b-2 dark:border-dark-5 cal-5-{{$i}}"></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <!-- END: Hoverable Table -->
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('style')
@endsection

@section('script')
@endsection