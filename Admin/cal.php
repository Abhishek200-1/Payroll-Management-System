<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Button to open the modal */
        .open-modal {
            display: block;
            margin: 50px auto;
            padding: 10px 20px;
            font-size: 1.2em;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .open-modal:hover {
            background-color: #0056b3;
        }

        /* Modal container */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-close {
            float: right;
            font-size: 1.5em;
            cursor: pointer;
        }

        .calculator {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(4, 1fr);
        }

        .calculator input,
        .calculator button {
            padding: 15px;
            font-size: 1.2em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .calculator input {
            grid-column: span 4;
            text-align: right;
            border: 1px solid #007bff;
        }

        .calculator button {
            background-color: #f1f1f1;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .calculator button:hover {
            background-color: #ddd;
        }

        .calculator button.operator {
            background-color: #007bff;
            color: white;
        }

        .calculator button.operator:hover {
            background-color: #0056b3;
        }

        .calculator button.double {
            grid-column: span 2;
        }
    </style>
</head>

<body>
    <!-- Button to open the modal -->
    <button class="open-modal" onclick="openModal()">Open Calculator</button>

    <!-- Modal -->
    <div id="calculatorModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close" onclick="closeModal()">&times;</span>
                <h2>Calculator</h2>
            </div>
            <div class="calculator">
                <input type="text" id="display" disabled>
                <button onclick="clearDisplay()">C</button>
                <button onclick="appendToDisplay('/')">/</button>
                <button onclick="appendToDisplay('*')">*</button>
                <button onclick="appendToDisplay('+')">+</button>
                <button onclick="appendToDisplay('7')">7</button>
                <button onclick="appendToDisplay('8')">8</button>
                <button onclick="appendToDisplay('9')">9</button>
                <button onclick="appendToDisplay('-')">-</button>
                <button onclick="appendToDisplay('4')">4</button>
                <button onclick="appendToDisplay('5')">5</button>
                <button onclick="appendToDisplay('6')">6</button>
                <button onclick="calculateResult()" class="operator">=</button>
                <button onclick="appendToDisplay('1')">1</button>
                <button onclick="appendToDisplay('2')">2</button>
                <button onclick="appendToDisplay('3')">3</button>
                <button onclick="appendToDisplay('0')" class="double">0</button>
                <button onclick="appendToDisplay('.')">.</button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('calculatorModal').style.display = 'flex';
            document.getElementById('display').focus();
        }

        function closeModal() {
            document.getElementById('calculatorModal').style.display = 'none';
        }

        function appendToDisplay(value) {
            document.getElementById('display').value += value;
        }

        function clearDisplay() {
            document.getElementById('display').value = '';
        }

        function calculateResult() {
            try {
                document.getElementById('display').value = eval(document.getElementById('display').value);
            } catch {
                document.getElementById('display').value = 'Error';
            }
        }

        // Keyboard controls
        document.addEventListener('keydown', function(event) {
            const key = event.key;
            if (key >= '0' && key <= '9' || key === '.' || key === '%') {
                appendToDisplay(key);
            } else if (key === 'Backspace') {
                clearDisplay();
            } else if (key === 'Escape') {
                closeModal();
            } else if (key === '/' || key === '*' || key === '-' || key === '+') {
                appendToDisplay(key);
            } else if (key === 'Enter') {
                calculateResult();
            }
        });

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            if (event.target === document.getElementById('calculatorModal')) {
                closeModal();
            }
        }
    </script>
</body>

</html>
