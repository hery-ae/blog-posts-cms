<x-layout>
    <table id="dt-post" class="table table-bordered table-hover table-striped w-100"></table>
    <script type="text/javascript" src="/jquery/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="/moment/min/moment.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            $.fn.dataTable.ext.errMode = 'throw'

            $('#dt-post').DataTable({
                responsive: true,
                paging: true,
                pageLength: 50,
                lengthChange: false,
                bInfo: false,
                order: [],
                select: true,
                dom: "<'row mb-3'" +
                    "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f>" +
                    "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>" +
                    ">" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        text: 'Create',
                        titleAttr: 'Create Post',
                        className: 'btn btn-outline-primary mr-1',
                        action: function ( e, dt, node, config ) {
                            window.location.replace(@json(route('posts.create')));
                        }
                    },
                    {
                        text: 'Edit',
                        titleAttr: 'Edit Post',
                        className: 'btn btn-outline-secondary mr-1',
                        action: function ( e, dt, node, config ) {
                            window.location.replace(String(@json(route('posts.index'))).concat('/').concat(dt.row('.selected').data().id).concat('/edit'))
                        }
                    },
                    {
                        text: 'Delete',
                        titleAttr: 'Delete Post',
                        className: 'btn btn-outline-danger mr-1',
                        action: function ( e, dt, node, config ) {
                            let form = document.createElement('form')
                            form.setAttribute('method', 'post')
                            form.setAttribute('action', String(@json(route('posts.index'))).concat('/').concat(dt.row('.selected').data().id))

                            let token = document.createElement('input')
                            token.setAttribute('type', 'hidden')
                            token.setAttribute('name', '_token')
                            token.setAttribute('value', $('meta[name="csrf-token"]').attr('content'))

                            form.appendChild(token)

                            let method = document.createElement('input')
                            method.setAttribute('type', 'hidden')
                            method.setAttribute('name', '_method')
                            method.setAttribute('value', 'DELETE')

                            form.appendChild(method)

                            document.body.appendChild(form)
                            form.submit()

                        }
                    }
                ],
                ajax: {
                    url: @json('/api/posts'),
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        Authorization: String('Bearer').concat(' ').concat($(document).find('[name="api-token"]').attr('content'))
                    }
                },
                columns: [
                    {
                        title: 'Title',
                        data: 'title'
                    },
                    {
                        title: 'Category',
                        data: 'category.verbose_name'
                    },
                    {
                        title: 'Created At',
                        data: 'created_at',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return moment(data).format('llll');
                        }
                    },
                    {
                        title: 'Updated At',
                        data: 'updated_at',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return moment(data).format('llll');
                        }
                    }
                ],
                language: {
                    infoFiltered: ''
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('pointer');
                },
                initComplete: function(settings, json) {
                    settings.oInstance.api().columns().header().to$().addClass('text-center');
                    settings.oInstance.api().table().header().classList.add('thead-dark');
				}
			})
		})
	</script>

</x-layout>