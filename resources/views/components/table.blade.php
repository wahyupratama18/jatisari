@props([
	'rows' => collect([]),
	'columns' => collect([]),
	'striped' => false,
	'actionText' => __('Tindakan'),
	'tableTextLinkLabel' => __('Link'),
])

<div 
	x-data="{
		columns: {{ $columns->toJson() }},
		rows: {{ $rows->toJson() }}.data,
		isStriped: Boolean({{ $striped }})
	}"
	x-cloak
>
	<div class="mb-5 overflow-x-auto rounded-lg shadow overflow-y-auto relative">          
		<table class="border-collapse table-auto w-full whitespace-no-wrap bg-slate-50 table-striped relative shadow">
			<thead>
				<tr class="text-left">
					@isset($tableColumns)
						{{ $tableColumns }}
					@else	 
						@isset($tableTextLink)
							<th class="bg-slate-50 sticky top-0 border-b border-slate-100 px-6 py-3 text-slate-500 font-bold tracking-wider uppercase text-xs truncate">
								{{ $tableTextLinkLabel }}
							</th>
						@endisset

						<template x-for="column in columns">
							<th 
								:class="`${column.columnClasses}`"
								class="bg-slate-50 sticky top-0 border-b border-slate-100 px-6 py-3 text-slate-500 font-bold tracking-wider uppercase text-xs truncate" 
								x-text="column.name"></th>
						</template>

						@isset($tableActions)
							<th class="bg-slate-50 sticky top-0 border-b border-slate-100 px-6 py-3 text-slate-500 font-bold tracking-wider uppercase text-xs truncate">{{ $actionText }}</th>
						@endisset
					@endisset
				</tr>
			</thead>
			<tbody>

				<template x-if="rows.length === 0">
					@isset($empty)
						{{ $empty }}
					@else
						<tr>
							<td colspan="100%" class="text-center py-10 px-4 text-sm">
								{{ __('Tidak ada data tersedia') }}
							</td>
						</tr>
					@endisset
				</template>

				<template x-for="(row, rowIndex) in rows" :key="'row-' +rowIndex">
					<tr :class="{'bg-slate-50': isStriped === true && ((rowIndex+1) % 2 === 0) }">
						@isset($tableRows)
							{{ $tableRows }}
						@else
							@isset($tableTextLink)
								<td
									class="text-slate-600 px-6 py-3 border-t border-slate-100 whitespace-nowrap">
									{{ $tableTextLink }}
								</td>
							@endisset

							<template x-for="(column, columnIndex) in columns" :key="'column-' + columnIndex">
								<td 
									:class="`${column.rowClasses}`"
									class="text-slate-600 px-6 py-3 border-t border-slate-100 whitespace-nowrap">
									<div x-text="`${row[column.field] ?? 0}`" class="truncate"></div>
								</td>
							</template>

							@isset($tableActions)
								<td
									class="text-slate-600 px-6 py-3 border-t border-slate-100 whitespace-nowrap">
									{{ $tableActions }}
								</td>
							@endisset
						@endisset
					</tr>
				</template>

			</tbody>
		</table>
	</div>
</div>