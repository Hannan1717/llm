<!-- resources/views/gemini_prompt.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gemini API Prompt</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
   <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-semibold text-center text-gray-800">Gemini API Prompt</h1>
      <form id="promptForm" class="mt-4">
         <label for="prompt" class="block text-sm font-medium text-gray-700">Masukkan Prompt</label>
         <input type="text" id="prompt" name="prompt" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
         <button type="submit"
            class="w-full mt-4 py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-500 transition duration-300 ease-in-out">
            Kirim
         </button>
      </form>
      <div id="responseContainer" class="mt-6">
         <h2 class="text-lg font-medium text-gray-800">Respons:</h2>
         <div id="responseText" class="mt-2 text-gray-700"></div>
      </div>
   </div>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
   <script>
      document.getElementById('promptForm').addEventListener('submit', function(event) {
         event.preventDefault();
         const prompt = document.getElementById('prompt').value;

         document.getElementById('responseText').innerHTML = '<p>Loading...</p>'; // Tampilkan loading

         axios.post('/create-conversation', {
               prompt: prompt
            })
            .then(response => {
               document.getElementById('responseText').innerHTML = response.data.response; // Tampilkan respons
            })
            .catch(error => {
               document.getElementById('responseText').innerText = 'Error: ' + error.response.data
               .message; // Tampilkan pesan error
            });
      });
   </script>
</body>

</html>
