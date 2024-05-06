<aside class="flex-shrink-0 w-64 bg-gray-900 text-white">
    <div class="flex items-center justify-center h-16 bg-gray-800">
        <a href="admin.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
            <h2 class="text-xl font-bold">Admin Panel</h2>
        </a>
    </div>
    <nav class="py-4">
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-800 dropdown-button">
                    <span>Pompier</span>
                </a>
                <!-- Dropdown content -->
                <ul class="ml-8 space-y-2 hidden dropdown transition-all duration-300 ease-in-out">
                    <li>
                        <a href="listepompier.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Liste Pompier</span>
                        </a>
                    </li>
                    <li>
                        <a href="ajoutpompier.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Ajout Pompier</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-800 dropdown-button">
                    <span>Engin</span>
                </a>
                <!-- Dropdown content -->
                <ul class="ml-8 space-y-2 hidden dropdown transition-all duration-300 ease-in-out">
                    <li>
                        <a href="ajoutengin.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Ajouter</span>
                        </a>
                    </li>
                    <li>
                        <a href="engin.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Liste Engin</span>
                        </a>
                    </li>
                    <li>
                        <a href="supprimerengin.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Supprimer</span>
                        </a>
                    </li>
                    <li>
                        <a href="modifierengin.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Modifier</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-800 dropdown-button">
                    <span>Caserne</span>
                </a>
                <!-- Dropdown content -->
                <ul class="ml-8 space-y-2 hidden dropdown transition-all duration-300 ease-in-out">
                    <li>
                        <a href="engincaserne.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Ajouter un engin à une caserne</span>
                        </a>
                    </li>
                </ul>
            </li>
            <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-800 dropdown-button">
                    <span>Employeur</span>
                </a>
                <!-- Dropdown content -->
                <ul class="ml-8 space-y-2 hidden dropdown transition-all duration-300 ease-in-out">
                    <li>
                        <a href="ajoutemployeur.php" class="flex items-center py-2 px-4 hover:bg-gray-800">
                            <span>Ajouter</span>
                        </a>
                    </li>
                </ul>
        </ul>
    </nav>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButtons = document.querySelectorAll('.dropdown-button');

        dropdownButtons.forEach(dropdownButton => {
            dropdownButton.addEventListener('click', function(event) {
                event.preventDefault();
                const dropdown = this.nextElementSibling; // Sélectionne le <ul> suivant
                dropdown.classList.toggle('hidden');
            });
        });

        // Ferme les dropdowns lorsqu'on clique en dehors
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const parent = dropdown.previousElementSibling; // Sélectionne le parent du dropdown
                if (!parent.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    });
</script>
