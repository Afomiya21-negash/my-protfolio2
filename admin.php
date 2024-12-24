<?php
require_once 'connection/db.php';
require_once 'about.php';
require_once 'experience.php';
require_once 'project.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Admin Panel</h1>
  
    <!-- About Section Management -->
    <section>
        <h2>Manage About Section</h2>
        <a href="edit_content.php?section=about">update the static content </a>

        <form action="add_content.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" >

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="picture">Picture:</label>
            <input type="file" id="picture" name="picture">

            <button type="submit" name="add_about">Add</button>
        </form>
      
        <h3>added About Content</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $aboutContent->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td>
                    <?php if (!empty($row['picture'])): ?>
                        <img src="<?= htmlspecialchars($row['picture']); ?>" alt="About Image" width="100">
                    <?php endif; ?>
                </td>
                <td>

                    <a href="edit_content.php?section=about&id=<?= $row['id']; ?>">Edit</a>
                    <a href="about.php?delete_about=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Experience Section Management -->
    <section>
        <h2>Manage Experience Section</h2>
        <a href="edit_content.php?section=experience">update the static content </a>

        <form action="add_content.php" method="POST">
            <input type="hidden" name="id" value="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <button type="submit" name="add_experience">Add</button>
        </form>

        <h3>added Experience Content</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $experienceContent->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="edit_content.php?section=experience&id=<?= $row['id']; ?>">Edit</a>
                    <a href="experience.php?delete_experience=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Projects Section Management -->
    <section>
        <h2>Manage Projects Section</h2>
        <a href="edit_content.php?section=projects">update the static content </a>

        <form action="add_content.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="url_link">Project Link:</label>
            <input type="url" id="url_link" name="url_link" required>

            <label for="picture">Picture:</label>
            <input type="file" id="picture" name="picture">

            <button type="submit" name="add_project">Add</button>
        </form>
       

        <h3>added Projects</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Link</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $projectContent->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><a href="<?= htmlspecialchars($row['url_link']); ?>" target="_blank">View Project</a></td>
                <td>
                    <?php if (!empty($row['picture'])): ?>
                        <img src="<?= htmlspecialchars($row['picture']); ?>" alt="Project Image" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit_content.php?section=project&id=<?= $row['id']; ?>">Edit</a>
                    <a href="project.php?delete_project=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>
</body>
</html>
