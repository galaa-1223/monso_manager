@extends('../manager.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ $page_title }} талбар</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher validate-form" action="{{ route('manager-tenhim-save') }}" method="post" 
                enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Анги нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Тэнхимийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="ner" placeholder="Ерөнхий эрдмийн тэнхим" class="form-control w-full border mt-2" 
                            minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" 
                            data-pristine-required-message="Тэхимийн нэр хоосон байж болохгүй"/>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" name="action" value="save" class="btn w-40 bg-theme-1 text-white ml-5">{{ __('site.add') }}</button>
                    </div>
                </div>
                <!-- END: Анги нэмэх -->
            </form>
        </div>
    </div> 
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-8">
        @if(!count($tenhims))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл ороогүй байна!
                </div>
            @else
            <table id="table" class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Хичээлийн нэр</th>
                        <th class="whitespace-nowrap text-center">Товч нэр</th>
                        <th class="whitespace-nowrap text-center">Багшийн тоо</th>
                        <th class="text-center whitespace-nowrap">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i = 1;?>
                        @foreach($tenhims as $tenhim)
                        <tr class="intro-x">
                            <td class="w-10">
                                <div class="flex">
                                <?=(($tenhims->currentpage()-1) * $tenhims->perpage() + $i);?>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="font-medium whitespace-nowrap">{{ $tenhim->ner }}</a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="font-medium whitespace-nowrap">{{ $tenhim->tovch }}</a>
                            </td>
                            <td class="text-center">
                                0
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ url('manager/tenhim/edit/'.$tenhim->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> {{ __('site.edit') }}
                                    </a>
                                    <a class="flex items-center text-theme-6 delete_button" href="javascript:;" data-id="{{ $tenhim->id }}" 
                                        data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> {{ __('site.delete') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                </tbody>
            </table>
            @endif
            {{ $tenhims->links() }}
        </div>
    </div> 
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-body p-0"> 
                    <form action="{{ route('manager-tenhim-delete-ajax') }}" method="post">
                    @csrf
                        <input type="hidden" class="t_id" name="t_id" value="">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Сонгосон тэнхимийг устгахыг хүсэж байна уу?</div>
                            <div class="text-gray-600 mt-2">Баазаас нэг мөсөн устгагдахыг анхаарна уу!</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="btn w-24 dark:border-dark-5 dark:text-gray-300 mr-1">{{ __('site.cancel') }}</button>
                            <button type="submit" class="modal_delete_button btn w-24 bg-theme-6 text-white">{{ __('site.delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('style')
@endsection

@section('script')
@endsection