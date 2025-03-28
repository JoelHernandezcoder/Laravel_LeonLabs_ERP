<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Medication
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-forms.form method="POST" action="/medications">
                    <div class="space-y-6">
                        <x-forms.input label="Name" name="name" required />
                        <x-forms.input label="Price" name="price" required />
                        <x-forms.input label="Description" name="description" required />
                        <x-forms.input label="Photo Url" name="photo" required />

                        <x-forms.divider/>

                        <div class="flex flex-col items-center space-y-4" id="supplies-section">
                            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                                List of Supplies for Production
                            </h2>

                            <div class="supply-row">
                                <div class="flex space-x-4">
                                    <x-forms.select
                                        label="Supply"
                                        name="supplies[0][id]"
                                        :options="$supplies"
                                        required
                                        class="supply-select"
                                    />
                                    <x-forms.input
                                        label="Quantity"
                                        name="supplies[0][quantity]"
                                        type="number"
                                        min="1"
                                        required
                                        class="quantity-input"
                                    />
                                    <x-forms.input
                                        label="Unit Code"
                                        name="supplies[0][unit_code]"
                                        type="text"
                                        readonly
                                        class="unit-code-input"
                                    />
                                    <x-danger-button
                                        type="button"
                                        class="remove-supply-btn mt-8"
                                    >
                                        Remove
                                    </x-danger-button>
                                </div>
                            </div>
                        </div>

                        <div class="text-center py-4">
                            <button
                                type="button"
                                id="add-supply-btn"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md"
                            >
                                Add Supply
                            </button>
                        </div>

                        <x-forms.divider/>

                        <div class="text-center py-4">
                            <x-forms.button>Create Medication</x-forms.button>
                        </div>
                    </div>
                </x-forms.form>

                <div class="ml-4 mb-4">
                    <x-action-button href="/medications">Medication's List</x-action-button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const suppliesSection = document.getElementById('supplies-section');
        const addSupplyBtn = document.getElementById('add-supply-btn');

        const supplies = @json($supplies);
        const unitCodes = @json($unit_codes);

        addSupplyBtn.addEventListener('click', function () {
            const newRowIndex = suppliesSection.children.length;
            const newRow = document.createElement('div');
            newRow.classList.add('supply-row');

            newRow.innerHTML = `
                <div class="flex space-x-4">
                    <x-forms.select
                        label="Supply"
                        name="supplies[${newRowIndex}][id]"
                        :options="$supplies"
                        required
                        class="supply-select"
                    />
                    <x-forms.input
                        label="Quantity"
                        name="supplies[${newRowIndex}][quantity]"
                        type="number"
                        min="1"
                        required
                        class="quantity-input"
                    />
                    <x-forms.input
                        label="Unit Code"
                        name="supplies[${newRowIndex}][unit_code]"
                        type="text"
                        readonly
                        class="unit-code-input"
                    />
                    <x-danger-button
                        type="button"
                        class="remove-supply-btn mt-8"
                    >
                        Remove
                    </x-danger-button>
                </div>
            `;

            suppliesSection.appendChild(newRow);

            newRow.querySelector('.remove-supply-btn').addEventListener('click', function () {
                newRow.remove();
            });

            const selectElement = newRow.querySelector('.supply-select');
            selectElement.addEventListener('change', function () {
                updateUnitCode(newRowIndex);
            });
        });

        suppliesSection.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-supply-btn')) {
                const row = event.target.closest('.supply-row');
                row.remove();
            }
        });

        function updateUnitCode(rowIndex) {
            const selectElement = document.querySelector(`select[name="supplies[${rowIndex}][id]"]`);
            const unitCodeInput = document.querySelector(`input[name="supplies[${rowIndex}][unit_code]"]`);
            const supplyId = selectElement.value;

            if (unitCodes[supplyId]) {
                unitCodeInput.value = unitCodes[supplyId];
            }
        }

        const supplySelects = document.querySelectorAll('.supply-select');
        supplySelects.forEach((select, index) => {
            select.addEventListener('change', function () {
                updateUnitCode(index);
            });
        });
    </script>
</x-app-layout>
