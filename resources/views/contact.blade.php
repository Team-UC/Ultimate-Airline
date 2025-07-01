<!DOCTYPE html>
<html lang="en">
    <x-header title="Contact Us" />

    <body>
        <header>
            <h1>Contact Us</h1>
        </header>
        
        <main>
            <p>If you have any questions, feel free to reach out!</p>

            <form action="#" method="POST">
                @csrf
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="5" required></textarea><br><br>

                <button type="submit">Send Message</button>
            </form>
        </main>
        <x-footer />
    </body>
</html>
