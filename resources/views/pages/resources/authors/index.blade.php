<x-app-layout>
    @if ($errors->any())
        <div id="is_invalid__"></div>
    @endif
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2" style="background-color: #f6f6f6;}">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        {{ __('Manage Authors') }}
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid" style="background-color: #f6f6f6;}">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid" style="padding-left: 0px!important; padding-right: 0px!important">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <form action="{{ route('authors.index') }}" method="GET">
                                <input type="text" id="user-search" name="search" data-kt-user-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Search Authors"  value="{{ request('search') }}" />
                            </form>                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Add Author-->
                            <a href="{{ route('authors.create') }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="ki-outline ki-plus fs-2"></i> Add Authors
                                </button>
                            </a>
                            <!--end::Add Author-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table id="authors-table" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Position</th>
                                <th class="min-w-125px">Created At</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        @foreach ($authors as $author)
                                <tr>
                                    <td>
                                        {{ $author->name }}
                                    </td>
                                    <td>{{ $author->position }}</td>
                                    <td>{{ $author->created_at }}</td>
                                    @canany(['journal-edit', 'journal-delete'])
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            @can('journal-edit')
                                            <div class="menu-item px-3">
                                                <a href="{{ route('authors.edit', ['author' => $author]) }}"
                                                    type="button" class="menu-link px-3 edit-role-btn">
                                                    Edit
                                                </a>
                                            </div>
                                            @endcan
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @can('journal-delete')
                                            <div class="menu-item px-3">
                                                <form id="delete-form-{{ $author->id }}"
                                                    action="{{ route('authors.destroy', ['author' => $author]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="menu-link px-3"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $author->id }}').submit();">Delete</a>
                                                </form>
                                            </div>
                                            @endcan
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    @endcanany
                                </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>
